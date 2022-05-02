<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4">
                <div class="my-4 d-flex justify-content-between align-items-center">
                    <h3>Create User</h3>
                    <Link href="/user" class="btn btn-primary">User List</Link>
                </div>
                <div>
                    <form @submit.prevent="saveUser">
                        <div class="mb-3">
                            <label>User Name</label>
                            <input type="text" v-model="name" :class="['form-control',{ 'is-invalid' : errors.name }]">
                            <div v-if="errors.name" class="invalid-feedback">{{ errors.name }}</div>
                        </div>
                        <div class="mb-3">
                            <label>User Email</label>
                            <input type="email" v-model="email" :class="['form-control',{ 'is-invalid' : errors.email }]">
                            <div v-if="errors.email" class="invalid-feedback">{{ errors.email }}</div>
                        </div>
                        <div class="mb-3">
                            <label>Photo</label>
                            <input type="file" ref="photo" accept="image/jpeg,image/png" :class="['form-control',{ 'is-invalid' : errors.email }]" @change="runFile">
                            <div v-if="errors.email" class="invalid-feedback">{{ errors.email }}</div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary">Create User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "create",
    data() {
        return {
            name: "",
            email: "",
            photo: "",
        }
    },
    props:[
      'errors'
    ],
    methods: {
        runFile() {
            this.photo = this.$refs.photo.files[0]
        },
        saveUser(){
            let user = {
                'name' : this.name,
                'email' : this.email,
                'photo' : this.photo
            }
            this.$inertia.post('/user',user);
        }
    },
}
</script>

<style scoped>

</style>
