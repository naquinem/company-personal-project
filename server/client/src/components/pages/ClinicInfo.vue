<script>
    import axios from 'axios';
    const axiosClient = axios.create({
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        }
    })
    export default{
        name: "ClinicInfo",
        data(){
            return {
                info: [],
                errorField: []
            }
        },
        mounted(){
            this.getData(this.$route.params.id)
        },
        methods: {
            async getData(id) {
                try {
                    const response = await axiosClient.get(`http://localhost:8000/api/clinic/show/${id}`);
                    this.info = response.data;
                }
                catch(error) {
                    if(error.response.status === 422) {
                        if(error.response.data.errors) {
                            this.errorField = error.response.data.errors;
                        } else {
                            this.errorField = "";
                        }
                    }
                }
            }
        }
    }
</script>
<template>
    <div class="clinic-show-container">       
        <div class="clinic-content">
            <div class="clinic-show-title">
                <h1>
                    Clinic Details
                </h1>
            </div>
            <div class="clinic-show-table">
                <table>
                    <thead class="clinic-show-thead">
                        <tr>
                            <th>
                                Clinic
                            </th>                           
                            <th>
                                Doctor                                
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
                    <tbody>
                        <tr 
                            v-for="data in this.info" 
                            :key="data.id" 
                            v-cloak
                            class="tr-clinic"
                        >
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
        th{
            font-size: 7px;
            padding: 2px;
        }
        td{
            font-size: 4px;
        }
        .clinic-show-container{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: auto;
        }
        .clinic-content{
            width: fit-content;
        }
        .clinic-show-title{
            font-size: 20px;
            margin-bottom: 15px;
        }
    }
    @media (min-width: 768px) and (max-width: 1024px) {
        th{
            font-size: 17px;
            padding: 2px;
        }
        td{
            font-size: 15px;
            margin: 10px;
            padding-left: 10px
        }
        .clinic-show-container{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: auto;
            padding: 1em;
        }
        .clinic-content{
            width: fit-content;
        }
        .clinic-show-title{
            font-size: 20px;
            margin-bottom: 15px;
        }
    }
    @media (min-width: 1025px) {
        th{
            font-size: 20px;
            padding: 2px;
        }
        td{
            font-size: 17px;
            margin: 10px;
            padding-left: 10px
        }
        .clinic-show-container{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: auto;
            padding: 1em;
        }
        .clinic-content{
            width: fit-content;
        }
        .clinic-show-title{
            font-size: 20px;
            margin-bottom: 15px;
        }
    }
    
</style>