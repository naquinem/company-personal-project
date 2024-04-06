<script>
import { RouterLink, RouterView } from 'vue-router';
    export default{
        name: "MainPage",
        components: {
            RouterLink,
            RouterView
        }
    }
</script>
<template>
    <div class="main-container">
        <nav class="main-navbar">
            <div class="main-links">
                <RouterLink to="/">
                    Spare Parts
                </RouterLink>
                <RouterLink to="/clinic">
                    Clinic Details
                </RouterLink>
            </div>
            <div class="login">
                <RouterLink to="/login">
                    Login
                </RouterLink>
            </div>
        </nav>
        <div class="child">
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
        th,td{
            font-size: 10px;
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
        }
        .icon{
            width: 15px;
        }
        
        .main-container{
            display: grid;
            grid-template-columns: 1fr;
        }
        .main-navbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            background-color: rgb(255, 123, 0);
            height: 3.5em;
            padding: 10px;
            margin-bottom: 3em;
        }
        .main-links{
            font-weight: 700;
            font-size: 12px;
        }
        .login{
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
        }
        .icon{
            width: 15px;
        }
        
        .main-container{
            display: grid;
            grid-template-columns: 1fr;
        }
        .main-navbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            height: 3.5em;
            background-color: rgb(255, 123, 0);
            padding: 25px;
            margin-bottom: 3em;
        }
        .main-links{
            font-weight: 700;
            font-size: 17px;
        }
        .login{
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
        }
        .icon{
            width: 15px;
        }
        
        .main-container{
            display: grid;
            grid-template-columns: 1fr;
        }
        .main-navbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            height: 3.5em;
            background-color: rgb(255, 123, 0);
            padding: 25px;
            margin-bottom: 3em;
        }
        .main-links{
            font-weight: 700;
            font-size: 20px;
        }
        .login{
            font-size: 17px;
            font-weight: 600;
        }
    }
</style>