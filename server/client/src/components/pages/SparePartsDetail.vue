<script>
    import axios from 'axios';
    const axiosClient = axios.create({
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        }
    })
    export default{
        name: "SparePartsDetail",
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
                    const response = await axiosClient.get(`http://localhost:8000/api/spare/show/${id}`);
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
    <div class="spare-show-container">       
        <div class="spare-content">
            <div class="spare-show-title">
                <h1>
                    Spare Parts Details
                </h1>
            </div>
            <div class="spare-show-table">
                <table>
                    <thead class="spare-show-thead">
                        <tr>
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
                    <tbody>
                        <tr 
                            v-for="data in this.info" 
                            :key="data.id" 
                            v-cloak
                            class="tr-spare"
                        >
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
        th{
            font-size: 10px;
        }
        td{
            font-size: 6px;
            padding: 5px;
        }
        .spare-show-container{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: auto;
        }
        .spare-content{
            width: fit-content;
        }
        .spare-show-title{
            font-size: 20px;
            margin-bottom: 15px;
        }
    }
    @media (min-width: 768px) and (max-width: 1024px) {
        th{
            font-size: 20px;
            padding: 2px;
        }
        td{
            font-size: 17px;
            margin: 10px;
            padding-left: 10px
        }
        .spare-show-container{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: auto;
            padding: 1em;
        }
        .spare-content{
            width: fit-content;
        }
        .spare-show-title{
            font-size: 20px;
            margin-bottom: 15px;
        }
    }
    @media (min-width: 1025px) {
        th{
            font-size: 25px;
            padding: 5px;
        }
        td{
            font-size: 20px;
            margin: 10px;
            padding-left: 15px
        }
        .spare-show-container{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: auto;
            padding: 1em;
        }
        .spare-content{
            width: fit-content;
        }
        .spare-show-title{
            font-size: 20px;
            margin-bottom: 15px;
        }
    }

</style>