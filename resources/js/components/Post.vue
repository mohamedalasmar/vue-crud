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
                        <h5
                            class="modal-title"
                            id="exampleModalLabel"
                            v-if="edit"
                        >
                            Edit Post
                        </h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-else>
                            Create Post
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
                            v-if="edit"
                            type="button"
                            class="btn btn-primary"
                            @click="updatePosts()"
                        >
                            Update
                        </button>
                        <button
                            v-else
                            type="button"
                            class="btn btn-primary"
                            @click="createPost()"
                        >
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-for="post in posts" :key="post.id" class="mt-4">
            <h3>{{ post.title }}</h3>
            <p>{{ post.body }}</p>
            <button
                type="button"
                data-toggle="modal"
                data-target="#exampleModal"
                class="btn btn-info btn-sm"
                @click="editPosts(post)"
            >
                Edit
            </button>

            <button
                type="button"
                class="btn btn-danger btn-sm"
                @click="deletePosts(post.id)"
            >
                Delete
            </button>
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
            edit: false, //To Change Create to Update
            posts: {},
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
                    this.errors = [];
                    this.post = {
                        id: "",
                        title: "",
                        body: ""
                    };
                }
            });
        },
        editPosts(post) {
            this.post = post;
            this.edit = true;
        },
        updatePosts() {
            axios
                .put("header/edit/" + this.post.id, this.post)
                .then(response => {
                    if (response.data.status === "error") {
                        this.errors = response.data.errors;
                    } else if (response.data.status == "success") {
                        Toast.fire({
                            icon: "success",
                            title: "Updated Successfully"
                        });
                        this.errors = [];
                        this.post = {
                            id: "",
                            title: "",
                            body: ""
                        };
                    }
                });
        },
        deletePosts(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios.delete("header/delete/" + id).then(response => {
                        if (response.data.status == "success") {
                            Swal.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                        }
                        this.getPosts();
                    });
                }
            });
        },

        getPosts() {
            axios.get("header/get").then(response => {
                this.posts = response.data.data;
            });
        }
    },

    created() {
        this.getPosts();
    }
};
</script>
