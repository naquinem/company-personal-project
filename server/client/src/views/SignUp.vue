<script>
import axios from 'axios';
    export default{
        name: "SignUp",
        data(){
            return {
                id: '',
                hash: '',
                username: '',
                email: '',
                password: '',
                cpassword: '',
                errorField: []
            }
        },
        methods: {
            async handleSubmit (){
                try{
                    const data = {
                        username: this.username,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.cpassword
                    }
                    const response = await axios({
                        method: "POST",
                        data: data,
                        url: "http://localhost:8000/api/register",
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/json",
                            "Access-Control-Allow-Origin": '*'
                        },                       
                    });
                    if(response.status === 200){
                        this.id = response.data.id;
                        this.hash = response.data.hash;
                        localStorage.setItem('token', response.data.token);
                        this.$router.push(`/email/verify/${this.id}/${this.hash}`);
                    }
                }
                catch (error){
                    if(error.response.status === 422){
                        if(error.response.data.errors.username){
                            this.errorField = error.response.data.errors.username[0];
                        } else if(error.response.data.errors.email){
                            this.errorField = error.response.data.errors.email[0];
                        } else if(error.response.data.errors.password){
                            this.errorField = error.response.data.errors.password[0];
                        }
                    }
                }
                
            }
        },
    }
</script>
<template>
    <div class="signup-main">
        <div class="signup">
            <h1 class="signup-title">
                Sign Up
            </h1>
            <div class="signup-error-field">
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
                    v-model="username"
                    placeholder="Username" 
                    autocomplete="on"
                >
                <input 
                    type="email" 
                    v-model="email" 
                    placeholder="Email"
                    autocomplete="on"
                >
                <input 
                    type="password" 
                    v-model="password" 
                    placeholder="Password"
                    autocomplete="off"
                >
                <input 
                    type="password" 
                    v-model="cpassword" 
                    placeholder="Confirm password"
                    autocomplete="off"
                >
                <button 
                    type="submit"
                    class="btn"
                >
                    Register
                </button>
                <p class="paragraph">
                    already had an account?
                </p>
                <RouterLink 
                    to="/login"
                    class="signin"
                >
                    Login
                </RouterLink>
            </form>
        </div>
    </div>
    
</template>
<style>
    @media (max-width: 767px) {
        .signup-main{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .signup{
            margin-top: 6em;
        }
        .signup-title{
            font-size: 17px;
        }
        .signup-error-field{
            margin-top: 4px;
            font-size: 8px;
            color: rgb(228, 47, 47);
        }
        .paragraph{
            margin-top: 10px;
        }
        .signin{
            margin-top: 15px;
            font-size: 12px;
            font-weight: 700;
            color: rgb(41, 41, 233);
        }
        .btn{
            padding: 6px;
            font-size: 12px;
        }
    }
    @media (min-width: 768px) and (max-width: 1024px) {
        .signup-main{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .signup{
            margin-top: 6em;
        }
        .signup-title{
            font-size: 25px;
        }
        .signup-error-field{
            margin-top: 10px;
            font-size: 12px;
            color: rgb(228, 47, 47);
            
        }
        .paragraph{
            margin-top: 10px;
        }
        .signin{
            margin-top: 18px;
            font-size: 15px;
            font-weight: 700;
            color: rgb(41, 41, 233);
        }
        .btn{
            padding: 6px;
            font-size: 16px;
        }
    }
    @media (min-width: 1025px) {
        .signup-main{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .signup{
            margin-top: 6em;
        }
        .signup-title{
            font-size: 25px;
        }
        .signup-error-field{
            margin-top: 10px;
            font-size: 10px;
            color: rgb(228, 47, 47);
        }
        .paragraph{
            margin-top: 10px;
        }
        .signin{
            margin-top: 18px;
            font-size: 15px;
            font-weight: 700;
            color: rgb(41, 41, 233);
        }
        .btn{
            padding: 6px;
            font-size: 20px;
        }
    }
</style>