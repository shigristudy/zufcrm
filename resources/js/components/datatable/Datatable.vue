<template>
    <table class="table dataTable">
        <thead>
            <tr>
                <th v-for="column in columns" :key="column.name"
                    :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting' + ' '+ column.clasess">
                    <span v-if="column.checkable">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" @click="$emit('selectall',select_all)" v-model="select_all" id="select_all_checkbox">
                            <label class="custom-control-label" for="select_all_checkbox"></label>
                        </div>
                    </span>
                   
                    <span v-else-if="column.sortable" @click="$emit('sort', column.name)">
                        <i class="feather icon-chevrons-down" :class="(sortOrders[column.name] == 1) ? 'icon-chevrons-down' : 'icon-chevrons-up'"></i>
                        {{column.label}}
                    </span>

                    <span v-else>
                        {{column.label}}
                    </span>
                </th>
            </tr>
        </thead>
        <slot></slot>
    </table>
</template>

<script>
    export default {
        props: ['columns', 'sortKey', 'sortOrders'],
        data(){
            return {
                select_all:false
            }
        },
        
    }
</script>