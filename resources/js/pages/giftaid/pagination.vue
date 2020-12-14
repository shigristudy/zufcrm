<template>
    <div class="d-flex flex-wrap mr-3">
        <a class="btn btn-icon btn-sm btn-light-primary mr-2 my-1" @click.prevent="changePage(1)" :disabled="pagination.current_page <= 1">
            <i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
        <a class="btn btn-icon btn-sm btn-light-primary mr-2 my-1" @click.prevent="changePage(pagination.current_page - 1)" :disabled="pagination.current_page <= 1">
            <i class="ki ki-bold-arrow-back icon-xs"></i></a>

        <a v-for="(page,i) in pages" :key="i" href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1" :class="isCurrentPage(page) ? 'active' : ''" @click.prevent="changePage(page)">{{ page }}</a>
        
        <a class="btn btn-icon btn-sm btn-light-primary mr-2 my-1" @click.prevent="changePage(pagination.current_page + 1)" :disabled="pagination.current_page >= pagination.last_page"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
        <a class="btn btn-icon btn-sm btn-light-primary mr-2 my-1" @click.prevent="changePage(pagination.last_page)" :disabled="pagination.current_page >= pagination.last_page"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>
    </div>

</template>

<style>
    .pagination {
        margin-top: 40px;
    }
</style>

<script>
    export default {
        props: ['pagination', 'offset'],
        methods: {
            isCurrentPage(page) {
                return this.pagination.current_page === page;
            },
            changePage(page) {
                if (page > this.pagination.last_page) {
                    page = this.pagination.last_page;
                }
                this.pagination.current_page = page;
                this.$emit('paginate');
            }
        },
        computed: {
            pages() {
                let pages = [];
                let from = this.pagination.current_page - Math.floor(this.offset / 2);
                if (from < 1) {
                    from = 1;
                }
                let to = from + this.offset - 1;
                if (to > this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                while (from <= to) {
                    pages.push(from);
                    from++;
                }
                return pages;
            }
        }
    }
</script>