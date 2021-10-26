<template>
    <div>
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn btn-success btn-sm float-right"
            data-toggle="modal"
            data-target="#exampleModal"
        >
            New Post
        </button>

        <!-- Modal -->
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            New Post
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input
                            :class="[
                                'form-control my-2',
                                errors.title ? 'is-invalid' : ''
                            ]"
                            placeholder="Please!Enter Your Title"
                            v-model="post.title"
                        />
                        <span v-if="errors.title" class="text-danger p-1">{{
                            errors.title[0]
                        }}</span>
                        <textarea
                            :class="[
                                'form-control my-2',
                                errors.body ? 'is-invalid' : ''
                            ]"
                            placeholder="Please!Enter Your Post"
                            v-model="post.body"
                        ></textarea>
                        <span v-if="errors.body" class="text-danger p-1">{{
                            errors.body[0]
                        }}</span>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="createPost"
                        >
                            New Post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            post: {
                id: "",
                title: "",
                body: ""
            },
            errors: []
        };
    },
    methods: {
        createPost() {
            axios.post("header/create", this.post).then(response => {
                if (response.data.status === "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {
                    Toast.fire({
                        icon: "success",
                        title: "Created Successfully"
                    });
                    this.errors =[]
                    this.post = {
                        id:'',
                        title:'',
                        body:''
                    }
                    // window.location.href = '/header'
                }
            });
        }
    }
};
</script>
