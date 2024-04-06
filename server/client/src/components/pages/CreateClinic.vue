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
        name: "CreateClinic",
        data(){
            return{
                store: {
                    name: '',
                    owner: '',
                    serial: '',
                    code: '',
                    installation: '',
                    product: '',
                    address: ''
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
                    clinic_name: this.store.name,
                    doctors_name: this.store.owner,
                    serial_number: this.store.serial,
                    clinic_code: this.store.code,
                    installation_date: this.store.installation,
                    product: this.store.product,
                    address: this.store.address
                }
                try{
                    const response = await axiosClient.post('http://localhost:8000/api/clinic/store', data);
                    if(response.status === 200){
                        window.alert('Successfully Submited Data');
                        window.location.href = '/clinic-store-details';
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
                    const response = await axiosClient.get('http://localhost:8000/api/clinic/index');
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
    <div class="clinic-container">
        <div class="clinic-form">
            <div class="clinic-store">
                <h1>
                    Add Clinic Details
                </h1>
                <form @submit.prevent="handleSubmit">
                    <input 
                        type="text" 
                        v-model="store.name"
                        placeholder="Clinic name"
                    >
                    <input 
                        type="text" 
                        v-model="store.owner"
                        placeholder="Doctor's Name"
                    >
                    <input 
                        type="text" 
                        v-model="store.serial"
                        placeholder="Serial Number"
                    >
                    <input 
                        type="text" 
                        v-model="store.code"
                        placeholder="Clinic Code"
                    >
                    <input 
                        type="text" 
                        v-model="store.installation"
                        placeholder="Installation Date"
                    >
                    <input 
                        type="text" 
                        v-model="store.product"
                        placeholder="Product Type"
                    >
                    <input 
                        type="text" 
                        v-model="store.address"
                        placeholder="Clinic Address"
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
                                Clinic Name
                            </th>                           
                            <th>
                                Doctor's Name
                            </th>
                            <th>
                                Serial Number
                            </th>
                            <th>
                                Clinic Code
                            </th>
                            <th>
                                Installation Date
                            </th>
                            <th>
                                Product Type
                            </th>
                            <th>
                                Clinic Address
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="data in this.info" :key="data.id">
                        <tr class="table">
                            <td>
                                {{ data.clinic_name }}
                            </td>
                            <td>
                                {{ data.doctors_name }}
                            </td>
                            <td>
                                {{ data.serial_number }}
                            </td>
                            <td>
                                {{ data.clinic_code }}
                            </td>
                            <td>
                                {{ data.installation_date }}
                            </td>
                            <td>
                                {{ data.product }}
                            </td>
                            <td>
                                {{ data.address }}
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
        .clinic-container{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
        }
        .clinic-store{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            width: fit-content;
        }
        .clinic-form{
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
        .clinic-show{
            margin-top: 1em;
            width: fit-content;
        }
        .table > th{
            font-size: 20px;
        }
        .table > td{
            font-size: 8px;
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
        .clinic-container{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
        }
        .clinic-store{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            width: fit-content;
        }
        .clinic-form{
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
        .clinic-show{
            margin-top: 1em;
            width: fit-content;
        }
        .table > th{
            font-size: 20px;
        }
        .table > td{
            font-size: 17px;
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
        .clinic-container{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
        }
        .clinic-store{
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            width: fit-content;
        }
        .clinic-form{
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
        .clinic-show{
            margin-top: 1em;
            width: fit-content;
        }
        .table > th{
            font-size: 20px;
        }
        .table > td{
            font-size: 17px;
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