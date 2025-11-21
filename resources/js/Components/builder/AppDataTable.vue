<script setup lang="ts">
import { useDatatableStore } from '@/stores/datatable';
import { DataItem, DataTableProps } from '@/types/datatable';
import { router } from '@inertiajs/vue3';
import { storeToRefs } from 'pinia';
import { onMounted, ref, watch } from 'vue';
import { route } from 'ziggy-js';
import AppDataTableActiveFilters from './table/AppDataTableActiveFilters.vue';
import AppDataTableContent from './table/AppDataTableContent.vue';
import AppDataTablePagination from './table/AppDataTablePagination.vue';
import AppDataTableToolbar from './table/AppDataTableToolbar.vue';

type RespProp = {
    data: DataTableProps;
};

defineSlots<{
    rowAction?: { item: DataItem };
    toolbarAction?: () => any;
}>();

const props = defineProps<{
    idx: string;
}>();

const store = useDatatableStore(props.idx)();

const name = store.tableData.name;
const prefix = store.tableData.prefix;
const disablePagination = store.tableData.disablePagination;

// --- watch filters, sort, query ---
const { sort, dir, searchQuery, activeFilters } = storeToRefs(store);
const firstRender = ref(true);
watch(
    [sort, dir, searchQuery, activeFilters],
    ([s, d, q, af], _, onCleanup) => {
        if (firstRender.value) {
            firstRender.value = false;
            return;
        }

        const handler = setTimeout(() => {
            const filterParams = af.reduce(
                (acc, filter) => {
                    if (
                        filter.value &&
                        Array.isArray(filter.value) &&
                        filter.value.length > 0
                    ) {
                        const joined =
                            filter.value.length > 1
                                ? filter.value.join(',')
                                : filter.value.toString();
                        acc[`${prefix}filter[${filter.field}]`] =
                            filter.operator
                                ? `${filter.operator}:${joined}`
                                : joined;
                    } else if (filter.value) {
                        acc[`${prefix}filter[${filter.field}]`] =
                            filter.operator
                                ? `${filter.operator}:${filter.value}`
                                : (filter.value as string);
                    }
                    return acc;
                },
                {} as Record<string, string>,
            );

            const params =
                Object.keys(filterParams).length > 0 ? filterParams : {};

            const routeUrl = store.tableData.tableRoute
                ? store.tableData.tableRoute
                : route(`${store.tableData.baseRoute}.index`);

            const searchParam = prefix + 'q';
            const sortByParam = prefix + 'sort';
            const sortDirParam = prefix + 'dir';

            router.get(
                routeUrl,
                {
                    ...(params ? { ...params } : {}),
                    [searchParam]: q,
                    [sortByParam]: s,
                    [sortDirParam]: d,
                },
                {
                    preserveScroll: true,
                    preserveState: true,
                    only: [name],
                    onSuccess: (page) => {
                        const props = page.props as unknown as RespProp;
                        store.updateItems(props.data.items);
                    },
                },
            );
        }, 350);

        onCleanup(() => clearTimeout(handler));
    },
);

onMounted(() => {
    // ĐỌC TẤT CẢ PARAM TỪ URL KHI F5 → ĐỔ VÀO STORE
    const params = new URLSearchParams(window.location.search);

    // 1. Global search
    const q = params.get(prefix + 'q');
    if (q !== null) {
        searchQuery.value = q;
    }

    // 2. Sort
    const s = params.get(prefix + 'sort');
    const d = params.get(prefix + 'dir');
    if (s) sort.value = s;
    if (d) dir.value = d || 'asc';

    // 3. Filters (hỗ trợ cả filter[name]=like:john và name=john)
    const newFilters: typeof activeFilters.value = [];

    // Duyệt tất cả filter definitions để biết field nào tồn tại
    store.tableData.filters.opt?.forEach((filterDef) => {
        const field = filterDef.field;

        // Ưu tiên lấy từ filter[name]=...
        const filterParam = params.get(`${prefix}filter[${field}]`);
        if (filterParam) {
            const [operator = 'like', valueStr] = filterParam.split(':');
            const value = valueStr.includes(',')
                ? valueStr.split(',')
                : valueStr;

            newFilters.push({ field, operator, value });
            return;
        }

        // Fallback: lấy trực tiếp từ ?name=john
        const directParam = params.get(field);
        if (directParam !== null && directParam !== '') {
            newFilters.push({
                field,
                operator: filterDef.type === 'date' ? '=' : 'like',
                value: directParam.includes(',')
                    ? directParam.split(',')
                    : directParam,
            });
        }
    });

    // Đẩy vào store
    if (newFilters.length > 0) {
        activeFilters.value = newFilters;
    }
});
</script>

<template>
    <div
        class="overflow-auto rounded-xl border bg-background text-foreground shadow-sm"
    >
        <AppDataTableToolbar :idx="idx">
            <template #toolbarAction>
                <slot name="toolbarAction" />
            </template>
        </AppDataTableToolbar>
        <AppDataTableActiveFilters :idx="idx" />
        <AppDataTableContent :idx="idx">
            <template #rowAction="{ item }">
                <slot name="rowAction" :item="item" />
            </template>
        </AppDataTableContent>

        <AppDataTablePagination v-if="!disablePagination" :idx="idx" />
    </div>
</template>
