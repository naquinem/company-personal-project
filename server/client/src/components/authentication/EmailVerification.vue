<script>
import axios from 'axios';

const axiosClient = axios.create({
    headers: {
        "Content-Type": "application/json"
    }
});
    export default{
        name: "EmailVerification",
        data(){
            return {
                notification: ''
            }
        },
        mounted(){
            this.getNotification();
        },
        methods: {
            async getNotification(){
                try{
                    const response = await axiosClient.get('http://localhost:8000/api/email/verify/notice');
                    if(response.status === 200) {
                        this.notification = response.data.message;
                    }
                }
                catch(error) {
                    console.log(error.response.data.errors);
                }
            },
            async getVerify(){         
                try{
                    const id = this.$route.params.id;
                    const hash = this.$route.params.hash
                    const response = await axiosClient.get(`http://localhost:8000/api/email/verify/${id}/${hash}`);
                    if(response.status === 200) {
                        window.alert(response.data.message);
                        this.$router.push('/login');
                    } 
                }
                catch(error){
                    console.log(error.response.data.error);
                }
            },
            // resendEmailVerification() {
            //     this.$router.push('/email/resend');
            // }
        }
    }
</script>
<template>
    <div class="verification">
        <div class="verification-content">
            <div>
                <p v-if="notification">
                    {{ notification }}
                </p>
            </div>
        </div>
        
    </div>
</template>
<style scoped>
    *{
        margin: 0;
        padding: 0;
        font-family: sans-serif, helvetica, Arial;
    }
    p{
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 4em;
    }
    button{
        padding: 1em;
        color: whitesmoke;
        background-color: red;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 500;
    }
    .verification{
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: auto;
        padding: 5em;
    }
    .verification-content{
        margin-top: 7em;
    }
</style>