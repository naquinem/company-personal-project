<script>
import axios from 'axios';

    export default{
        name: "SignIn",
        data(){
            return {
                email: '',
                password: '',
                errorField: []
            }
        },
        methods:{
            async handleSubmit (){
                const data = {
                    email: this.email,
                    password: this.password
                }
                try{
                    const response = await axios({
                        method: "POST",
                        data: data,
                        url: "http://localhost:8000/api/login",
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/json",
                            "Access-Control-Allow-Origin": '*'
                        },
                        
                    });
                    if(response.status === 200){
                        localStorage.setItem('token', response.data.token);
                        this.$router.push('/home');
                    }
                }
                catch(error){
                    if(error.response.status === 422){
                        if(error.response.data.message){
                            this.errorField = error.response.data.message
                        } else if(error.response.data.errors.email){
                            this.errorField = error.response.data.errors.email
                        } else if(error.response.data.errors.password){
                            this.errorField = error.response.data.errors.password
                        }
                    }
                }
                
            }
        }
    }
</script>
<template>
    <div class="sign-main">
        <div class="signin-page">
            <h1 class="signin-title">
                Sign In
            </h1>
            <div class="signin-error-field">
                <ul 
                    v-if="Object.keys(this.errorField).length > 0"
                >
                    <li>
                        {{ errorField }}
                    </li>
                </ul>
            </div>
            <form 
                class="form" 
                @submit.prevent="handleSubmit"
            >
                <input 
                    type="text" 
                    v-model="email" 
                    autocomplete="on"
                    placeholder="Email"
                >
                <input 
                    type="password" 
                    v-model="password" 
                    autocomplete="on"
                    placeholder="Password"
                >
                <button 
                    type="submit"
                    class="btn"
                >
                    Login
                </button>
                <p class="login-paragraph">
                    don't have an account yet?
                </p>
                <RouterLink 
                    to="/register"
                    class="register"
                >
                    Register
                </RouterLink>
            </form>
        </div>
    </div>
</template>
<style>
    @media (max-width: 767px) {
        .sign-main{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .signin-page{
            margin-top: 6em;
        }
        .signin-title{
            font-size: 17px;
        }
        .signin-error-field{
            margin-top: 4px;
            font-size: 8px;
            color: rgb(228, 47, 47);
        }
        .login-paragraph{
            margin-top: 10px;
            font-weight: 500;
        }
        .register{
            margin-top: 15px;
            font-size: 12px;
            font-weight: 600;
            color: rgb(41, 41, 233);
        }
    }
    @media (min-width: 768px) and (max-width: 1024px) {
        .sign-main{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .signin-page{
            margin-top: 6em;
        }
        .signin-title{
            font-size: 25px;
        }
        .signin-error-field{
            margin-top: 10px;
            font-size: 15px;
            color: rgb(228, 47, 47);
        }
        .login-paragraph{
            margin-top: 10px;
        }
        .btn{
            padding: 6px;
            font-size: 16px;
        }
        .register{
            margin-top: 18px;
            font-size: 15px;
            font-weight: 600;
            color: rgb(41, 41, 233);
        }
    }
    @media (min-width: 1025px) {
        .sign-main{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .signin-page{
            margin-top: 6em;
        }
        .signin-title{
            font-size: 25px;
        }
        .signin-error-field{
            margin-top: 10px;
            font-size: 15px;
            color: rgb(228, 47, 47);
        }
        .login-paragraph{
            margin-top: 10px;
        }
        .btn{
            padding: 6px;
            font-size: 20px;
        }
        .register{
            margin-top: 18px;
            font-size: 15px;
            font-weight: 600;
            color: rgb(41, 41, 233);
        }
    }
    
</style>