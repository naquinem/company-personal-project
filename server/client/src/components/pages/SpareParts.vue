<script>
    import axios from 'axios';

    const axiosClient = axios.create({
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        }
    });
    axiosClient.interceptors.request.use(
        config => {
            const token = localStorage.getItem('token');
            if(token){
                config.headers.Authorization = `Bearer ${token}`;
            }
            return config
        },
        error => {
            return new Promise.reject(error);
        }
    );

    export default{
        name: "SpareParts",
        data(){
            return{
                info: [],
                outputData: [],
                errorData: [],
                searchTerm: ''
            }
        },
        mounted() {
            this.getData()
        },
        methods: {
            async getData(){
                try{
                    const response = await axiosClient.get('http://localhost:8000/api/spare/index');
                    if(response.status === 200){
                        this.info = response.data.data;                    }
                }
                catch(error) {
                    if(error.response.data.errors){
                        this.errorData = error.response.data.errors;
                    } else {
                        this.errorData = ""
                    }
                }
            },
            getSearch() {
                if (this.searchTerm.trim() === '') {
                    this.outputData = [];
                    return;
                }
                this.outputData = this.info.filter((item) => {
                    return item.description.toUpperCase().includes(this.searchTerm.toUpperCase());
                });
            }
        }
    }
</script>
<template>
    <div class="spare-container">
        <div class="spare-show">
            <i>
                Search Spare Parts Name
            </i>
            <div class="input-div">
                <div class="spare-input">
                    <div class="icon">
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            fill="none" viewBox="0 0 24 24" 
                            stroke-width="1.5" 
                            stroke="currentColor" 
                            class="w-6 h-6"
                        >
                            <path 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" 
                            />
                        </svg>
                    </div>
                    <div>
                        <input  class="spare-search-input"
                            type="text" 
                            v-model="this.searchTerm" 
                            @input="getSearch" 
                            placeholder="Search...."
                        >
                    </div>
                </div>
            </div>
                       
            <div class="table-container">
                <div>
                    <ul 
                        class="table" 
                        v-for="data in this.outputData" 
                        :key="data.id" v-cloak
                    >                      
                        <li>
                            <RouterLink :to="{path: `/spare/${data.id}`}">
                                {{ data.description }}
                            </RouterLink>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</template>
<style>
    @media (max-width: 767px) {
        .spare-container{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2em;
        }
        .spare-show {
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            width: 10em;
            margin: auto;
        }
        .spare-input{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: auto;
            border: 1px solid gray;
            border-radius: 10px;
            margin-top: 10px;
        }
        .icon{
            width: 1.5em;
            padding-left: 5px;
        }
        .spare-search-input{
            width: 10em;
            height: 1em;
            font-size: 14px;
            padding-left: 2px;
            margin: 5px;
            border: none;
            outline: none;
        }
    }
    @media (min-width: 768px) and (max-width: 1024px){
        .spare-container{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2em;
        }
        .spare-show{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            width: 22em;
            margin: auto;
        }
        .spare-input{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: auto;
            border: 1px solid gray;
            border-radius: 10px;
            margin-top: 10px;
        }
        .icon{
            width: 2em;
            padding-left: 5px;
        }
        .spare-search-input{
            width: 20em;
            height: 2em;
            font-size: 15px;
            padding-left: 5px;
            margin: 5px;
            border: none;
            outline: none;
        }
    }
    @media (min-width: 1025px){
        .spare-container{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2em;
        }
        .spare-show{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            width: 30em;
            margin: auto;
        }
        .spare-input{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border: 1px solid gray;
            border-radius: 10px;
            margin-top: 10px;
        }
        .icon{
            width: 2.5em;
            padding-left: 5px;
        }
        .spare-search-input{
            width: 25em;
            height: 2.5em;
            font-size: 17px;
            padding: 10px;
            margin: 5px;
            border: none;
            outline: none;
        }
    }
</style>