<template>
    <div>
        <input
            type="text"
            class="form-control mt-4"
            placeholder="Please!Enter Your Email"
            v-model="user.name"
        />

        <input
            type="password"
            class="form-control mt-2"
            placeholder="Please!Enter Your Password"
            v-model="user.password"
        />
        <button class="btn btn-block m-2 btn-primary " @click="login">
            Login
        </button>
        <div class="alert alert-danger" v-if="error">Error !</div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: {
                name: "",
                password: ""
            },
            error: false
        }
    },
    methods: {
        login() {
            axios.post("header/login", this.user).then(response => {
                if (response.data.status == "success") {
                    let token = response.data.token
                    localStorage.setItem("token", token)
                    this.error = false
                      Toast.fire({
                            icon: "success",
                            title: "Login Successfully"
                        })

                } else {
                    this.error = true
                }
            })
        }
    }
}
</script>
