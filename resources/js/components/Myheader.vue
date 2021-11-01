<template>

<div class="text-center">
<router-link to="/login" class="btn btn-success m-2">Login</router-link>
<router-link to="/register" class="btn btn-danger m-2">Register</router-link>
<router-link to="/post" class="btn btn-info m-2">Post</router-link>
<button class="btn btn-danger btn-m m-1" @click="logout">Logout</button>
</div>
</template>
<script>
export default {
    data(){
        return{

        }
    },
    methods:{
        logout(){
            let token = localStorage.getItem('token')
            axios.post('header/logout?token='+token).then(response=>{
                localStorage.setItem('token','')
                    Toast.fire({
                            icon: "success",
                            title: "logout Successfully"
                        });
            })
        }

    }
}
</script>
