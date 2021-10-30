<template>
    <div>
        <input
            type="text"
            class="form-control mt-4"
            placeholder="Please!Enter Your Name"
            v-model="user.name"
        />
        <input
            type="email"
            class="form-control mt-2"
            placeholder="Please!Enter Your Email"
            v-model="user.email"
        />
        <input
            type="password"
            class="form-control mt-2"
            placeholder="Please!Enter Your Password"
            v-model="user.password"
        />
        <button class="btn btn-block m-2 btn-primary " @click="register">
            Register
        </button>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: {
                name: "",
                email: "",
                password: ""
            }
        }
    },
    methods: {
        register() {
            axios.post("header/register", this.user).then(response => {
                    Toast.fire({
                        icon: "success",
                        title: "Registerd Successfully"
                    });
            })
        }
    }
}
</script>
