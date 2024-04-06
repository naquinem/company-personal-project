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
        name: "CreateSpare",
        data(){
            return{
                store: {
                    itemcode: '',
                    description: '',
                    quantity: '',
                    price: ''
                },
                info: [],
                errorData: [],
                errorField: [],
            }
        },
        mounted() {
            this.getData()
        },
        methods: {
            async handleSubmit(){
                const data = {
                    item_code: this.store.itemcode,
                    description: this.store.description,
                    quantity: this.store.quantity,
                    price: this.store.price,
                }               
                try{
                    const response = await axiosClient.post('http://localhost:8000/api/spare/store', data);
                    if(response.status === 200){
                        window.alert('Successfully Submited Data');
                        window.location.href = '/home';
                        
                    }
                }
                catch(error){
                    if(error.response.status === 422){
                        if(error.response.data.errors){
                            this.errorField = error.response.data.errors;
                        } else{
                            this.errorField = "";
                        }   
                    }
                }
            },
            async getData(){
                try{
                    const response = await axiosClient.get('http://localhost:8000/api/spare/index');
                    if(response.status === 200){
                        this.info = response.data.data;
                    }
                }
                catch(error) {
                    if(error.response.data.errors){
                        this.errorData = error.response.data.errors;
                    } else {
                        this.errorData = ""
                    }
                }
            }
        }
    }
</script>
<template>
    <div class="spare-container">
        <div class="spare-form">
            <div class="spare-store">
                <h1>
                    Add Spare Details
                </h1>
                <form @submit.prevent="handleSubmit">
                    <input 
                        type="text" 
                        v-model="store.itemcode"
                        placeholder="Item Code"
                    >
                    <input 
                        type="text" 
                        v-model="store.description"
                        placeholder="Description"
                    >
                    <input 
                        type="text" 
                        v-model="store.quantity"
                        placeholder="Quantity"
                    >
                    <input 
                        type="text" 
                        v-model="store.price"
                        placeholder="Price"
                    >
                    <button 
                        type="submit"
                        class="submit"
                    >
                        Submit
                    </button>
                </form>
            </div>
        </div>
        
        <div class="clinic-show">
            <h1>
                Dental Clinic's Information
            </h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr class="table-head">
                            <th>
                                Item Code
                            </th>                           
                            <th>
                                Description
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Price
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="data in this.info" :key="data.id">
                        <tr class="table">
                            <td>
                                {{ data.item_code }}
                            </td>
                            <td>
                                {{ data.description }}
                            </td>
                            <td>
                                {{ data.quantity }}
                            </td>
                            <td>
                                {{ data.price }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<style>
    @media (max-width: 767px) {
        input{
            margin-bottom: 10px;
            font-size: 12px;
            outline: none;
            height: 1.5em;
            padding-left: 5px;
            width: 15em;
            height: 1.8em;
        }
        form{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            margin-top: 1em;
            width: fit-content;
        }
        th{
            font-size: 8px;
        }
        td{
            font-size: 6px;
            padding: 2px;
        }
        .spare-container{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
        }
        .spare-store{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            width: fit-content;
        }
        .spare-form{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: auto;
        }
        .submit{
            padding: 5px;
            border-radius: 3px;
            color: white
        }
        .spare-show{
            margin-top: 1em;
        }
        .table-container{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-top: 1em;
        }
    }
    @media (min-width: 768px) and (max-width: 1024px){
        input{
            margin-bottom: 10px;
            font-size: 12px;
            outline: none;
            height: 1.5em;
            width: 20em;
            height: 2em;
            padding-left: 5px;
        }
        form{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            margin-top: 1em;
            width: fit-content;
        }
        th{
            font-size: 14px;
        }
        td{
            font-size: 12px;
            padding: 5px;
        }
        .spare-container{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
        }
        .spare-store{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            width: fit-content;
        }
        .spare-form{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: auto;
        }
        .submit{
            padding: 5px;
            border-radius: 3px;
            font-size: 15px;
            color: white
        }
        .spare-show{
            margin-top: 1em;
        }
        .table-container{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-top: 1em;
        }
    }
    @media (min-width: 1025px){
        input{
            margin-bottom: 10px;
            font-size: 12px;
            outline: none;
            height: 2.5em;
            width: 20em;
            padding-left: 10px;
        }
        form{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            margin-top: 1em;
            width: fit-content;
        }
        th{
            font-size: 20px;
        }
        td{
            font-size: 17px;
            padding: 10px;
        }
        .spare-container{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
        }
        .spare-store{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            width: fit-content;
        }
        .spare-form{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: auto;
        }
        .submit{
            padding: 5px;
            border-radius: 3px;
            font-size: 15px;
            color: white
        }
        .spare-show{
            margin-top: 1em;
        }
        .table-container{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-top: 1em;
        }
    }
</style>