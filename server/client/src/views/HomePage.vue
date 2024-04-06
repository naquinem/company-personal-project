<script>
    import axios from 'axios';
    const axiosClient = axios.create({
        baseURL: "http://localhost:8000/api",
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        }
    });
    axiosClient.interceptors.request.use(
        (config) => {
            const token = localStorage.getItem('token');
            if(token){
                config.headers.Authorization = `Bearer ${token}`;
            }
            return config;
        },
        (error) => {
            return new Promise.reject(error);
        }
    );
    export default{
        name: "HomePage",
        data(){
            return {
                errorField: []
            }
        },
        methods: {
            async handleLogout(){
                try{
                    const response = await axiosClient.post('/logout');
                    if(response.status === 200){
                        localStorage.removeItem('token');
                        window.alert(response.data.message);
                        this.$router.push('/');
                    }
                }
                catch(error){
                    if(error.response.status === 401){
                        if(error.response.data.message){
                            this.errorField = error.response.data.message;
                            window.alert(error.response.data.message)
                        } else {
                            this.errorField = "";
                        }
                        if(error.response.data.errors){
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
    <div class="home-container">
        <nav class="home-navbar">
            <div class="home-links">
                <RouterLink to="/home">
                    Spare Parts
                </RouterLink>
                <RouterLink to="/clinic-store-details">
                    Clinic Details
                </RouterLink>
            </div>
            <div class="logout">
                <button 
                    @click.prevent="handleLogout" 
                    class="logout"
                >
                    Logout
                </button>
            </div>
        </nav>
        <div class="children">
            <RouterView/>
        </div>
    </div>
</template>
<style>
*{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif, Helvetica;
    }
    @media (max-width: 767px) {
        ul,li{
            list-style-type: none;
        }
        a{
            text-decoration: none;
            list-style-type: none;
            color: black;
            margin-left: 10px;
            margin-right: 5px;
        }
        a:hover{
            color: rgb(87, 78, 78);
        }
        a:focus{
            color: rgb(79, 79, 212);
        }

        p{
            font-size: 14px;
        }
        h1{
            font-size: 14px;
        }
        i{
            font-size: 14px;
        }
        input{
            width: 10em;
        }
        label{
            font-size: 10px;
        }
        button{
            background-color: rgb(255, 123, 0);
            font-size: 10px;
            border: none;
            padding: 5px;
            border-radius: 5px;
        }
        button:hover{
            background-color: rgb(168, 83, 3);
            color: white;
        }
        .icon{
            width: 15px;
        }
        
        .home-container{
            display: grid;
            grid-template-columns: 1fr;
        }
        .home-navbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            background-color: rgb(255, 123, 0);
            height: 3.5em;
            padding: 10px;
            margin-bottom: 5px;
        }
        .home-links{
            font-weight: 700;
            font-size: 12px;
        }
        .logout{
            font-size: 10px;
            font-weight: 500;
        }
    }
    @media (min-width: 768px) and (max-width: 1024px){
        ul,li{
            list-style-type: none;
        }
        a{
            text-decoration: none;
            list-style-type: none;
            color: black;
            margin-left: 10px;
            margin-right: 5px;
        }
        a:hover{
            color: rgb(87, 78, 78);
        }
        a:focus{
            color: rgb(79, 79, 212);
        }
        th,td{
            font-size: 15px;
        }
        p{
            font-size: 17px;
        }
        h1{
            font-size: 17px;
        }
        i{
            font-size: 17px;
        }
        input{
            width: 10em;
        }
        label{
            font-size: 17px;
        }
        button{
            background-color: rgb(255, 123, 0);
            font-size: 10px;
            border: none;
            padding: 5px;
            border-radius: 5px;
        }
        button:hover{
            background-color: rgb(168, 83, 3);
            color: white;
        }
        .icon{
            width: 15px;
        }
        
        .home-container{
            display: grid;
            grid-template-columns: 1fr;
        }
        .home-navbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            height: 3.5em;
            background-color: rgb(255, 123, 0);
            padding: 25px;
            margin-bottom: 1em;
        }
        .home-links{
            font-weight: 700;
            font-size: 17px;
        }
        .logout{
            font-size: 15px;
            font-weight: 600;
        }
    }
    @media (min-width: 1025px){
        ul,li{
            list-style-type: none;
        }
        a{
            text-decoration: none;
            list-style-type: none;
            color: black;
            margin-left: 10px;
            margin-right: 5px;
        }
        a:hover{
            color: rgb(87, 78, 78);
        }
        a:focus{
            color: rgb(79, 79, 212);
        }
        ul,li{
            text-decoration: none;
        }
        th,td{
            font-size: 17px;
        }
        p{
            font-size: 17px;
        }
        h1{
            font-size: 20px;
        }
        i{
            font-size: 17px;
        }
        input{
            width: 10em;
        }
        label{
            font-size: 17px;
        }
        button{
            background-color: rgb(255, 123, 0);
            font-size: 10px;
            border: none;
            padding: 5px;
            border-radius: 5px;
        }
        button:hover{
            background-color: rgb(168, 83, 3);
            color: white;
        }
        .icon{
            width: 15px;
        }
        
        .home-container{
            display: grid;
            grid-template-columns: 1fr;
        }
        .home-navbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            height: 3.5em;
            background-color: rgb(255, 123, 0);
            padding: 25px;
            margin-bottom: 1em;
        }
        .home-links{
            font-weight: 700;
            font-size: 20px;
        }
        .logout{
            font-size: 17px;
            font-weight: 600;
        }
    }
</style>