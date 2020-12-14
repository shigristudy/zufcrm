<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center mt-2">
            <!-- <li class="page-item prev" v-if="pagination.prevPageUrl" @click="$emit('prev');"><a class="page-link" href="#">Prev</a></li>
            <li class="page-item prev" :class="(!pagination.prevPageUrl) ? 'disabled':''" v-else><a class="page-link" href="#">Prev</a></li> -->
            <li class="page-item" v-for="(page,i) in pagination.links" :key="i"
                :class="isCurrentPage(page.label) ? 'active' : ''" @click.prevent="changePage(page.url)">
                <!-- @click.prevent="changePage(page)" -->
                <a class="page-link" v-html="page.label"></a>
            </li>
            <!-- <li class="page-item next" v-if="pagination.nextPageUrl" @click="$emit('next');"><a class="page-link" href="#">Next</a></li>
            <li class="page-item next" :class="(!pagination.nextPageUrl) ? 'disabled':''" v-else><a class="page-link" href="#">Next</a></li> -->
        </ul>
    </nav>
    
</template>

<script>
    export default {
        props: ['pagination', 'filtered'],
        methods: {
            isCurrentPage(page) {
                return this.pagination.currentPage === page;
            },
            changePage(page) {
                if (page > this.pagination.lastPage) {
                    page = this.pagination.lastPage;
                }
                this.pagination.currentPage = page;
                this.$emit('getpageData',page);
            }
        },
        computed: {
            
        }
    }
</script>

<style lang="scss">
.pagination {
    justify-content: flex-end !important;
    .page-stats {
        align-items: center;
        margin-right: 5px;
    }
    i {
        color: #3273dc !important;
    }
}
</style>