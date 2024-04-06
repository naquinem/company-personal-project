import { createRouter, createWebHistory } from "vue-router";
import HomePage from "@/views/HomePage.vue";
import SignIn from "@/views/SignIn.vue";
import SignUp from "@/views/SignUp.vue";
import ResetPassword from "@/views/ResetPassword.vue";
import GuestLayout from "../components/GuestLayout.vue";
import MainPage from "../views/MainPage.vue";
import ClinicDetails from "../components/pages/ClinicDetails.vue";
import SpareParts from "../components/pages/SpareParts.vue";
import CreateSpare from "../components/pages/CreateSpare.vue";
import CreateClinic from "../components/pages/CreateClinic.vue";
import SparePartsDetail from "../components/pages/SparePartsDetail.vue";
import ClinicInfo from "../components/pages/ClinicInfo.vue";
import EmailVerfication from "../components/authentication/EmailVerification.vue";

const routes = [
    {
        path: '/',
        component: GuestLayout,
        children: [
            {
                path: '/',
                component: MainPage,
                children: [
                    {
                        path: '/clinic',
                        component: ClinicDetails
                    },
                    {
                        path: '/',
                        component: SpareParts
                    },
                    {
                        path: '/spare/:id',
                        component: SparePartsDetail
                    },
                    {
                        path: '/clinic/:id',
                        component: ClinicInfo
                    }
                ]
            },
            {
                path: '/login',
                component: SignIn
            },
            {
                path: '/register',
                component: SignUp
            },
            {
                path: '/email/verify/:id/:hash',
                component: EmailVerfication
            },
        ]
    },
    {
        path: '/home',
        component: HomePage,
        children: [
            {
                path: '/home',
                component: CreateSpare
            },
            {
                path: '/clinic-store-details',
                component: CreateClinic
            },
            
        ]
    }, 
    {
        path: '/reset/:id',
        component: ResetPassword
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;