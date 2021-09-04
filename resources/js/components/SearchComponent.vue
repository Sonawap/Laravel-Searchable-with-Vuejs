<template>
    <div class="container mt-5 bg-white p-3">
        <h4>Search our Knowledgebase</h4>
        <div class="input-group input-group-lg mt-4">
            <input type="text" class="form-control form-control-warning" @keyup="search" @keypress.enter="search" v-model="searchWord" placeholder="Search by name, post title, category"  aria-label="Large" aria-describedby="inputGroup-sizing-sm">
        </div>

        <div class="mt-5" v-if="show&searchWord != ''">
            <h4>{{ count }} Search Results for: {{ searchWord }} </h4>
            <div class="mt-3" v-for="(result, i) in results" :key="result.type">
                <h4 class="result-type">{{ i }}</h4>
                <ul v-for="item in result" :key="item.id">
                    <a :href="result.url">
                        <li>
                            <div class="media">
                                <div class="media-left" v-if="item.type != 'categories'">
                                    <img :src="item.searchable.avatar">
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading">{{ item.searchable.name }}</h5>
                                    <p>{{ item.searchable.description }}</p>
                                </div>
                            </div>
                        </li>
                    </a>
                </ul>
            </div>
        </div>
        <div class="alert alert-info mt-3" v-else>
            Start typing to search
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                show: false,
                searchWord: '',
                results: [],
                count: 0
            }
        },

        methods:{
            search(){
                this.show = true;
                axios.get('/api/search', {params:{'s': this.searchWord}}).then((response) =>{
                    this.results = response.data.results;
                    this.count = response.data.total_result_count
                });
            }
        }
    }
</script>


<style lang="scss" scoped>
    .result-type{
        font-size: 16px;
        font-weight: 600;
    }
    .media{
        .media-left{
            margin-right: 10px;
            img{
                height: 100px;
                width: 100px;
            }
        }
        .media-body{
            h5{
                font-size: 15px;
                font-weight: 600;
            }
            p{
                margin-bottom: 0px;
            }
        }
    }
    ul {
        list-style: none;
        padding: 0;

        a{
            color: inherit;

            &:hover{
                text-decoration: none !important;
            }
        }

        li{
            color: #4a4a4a;
            font-weight: normal;
            line-height: 30px;
            font-size: 14px;
            padding:10px;
            cursor: pointer;
            &:hover{
                box-shadow: 1px 1px 4px #4a4a4a5e;
            }
        }
    }
</style>
