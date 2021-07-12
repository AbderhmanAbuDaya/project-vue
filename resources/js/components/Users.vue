<template>
    <div class="container">
        <not-found v-if="!this.$gate.isAdminOrAuthor()" ></not-found>
        <div class="row justify-content-center " v-if="this.$gate.isAdminOrAuthor()">
            <div class="col-md-12 mt-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-users orange"></i> Users Table</h3>
                      <div class="card-tools">
                          <button class="btn btn-success " @click="addUser">Add user <i class="fa fa-user-plus fw orange"></i> </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Register At</th>
                                <th>Modify</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="user in users.data">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.type | upText}}</td>
                                <td>{{user.created_at | myDate}}</td>
                                <td>
                                <a  @click="editUser(user)"><i class="fa fa-edit green"></i></a>
                                <a  @click="deleteUser(user.id)"><i class="fa fa-trash red"></i></a>
                                </td>
                            </tr>
                            <pagination :data="users" @pagination-change-page="getResults"></pagination>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

        <div class="modal" id="addNew" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="createUser">
                        <div class="mb-3">
                            <input id="name"
                                   placeholder="Name"
                                   v-model="form.name"
                                   type="text" name="name"
                                   class="form-control"
                                   :class="{'is_invalid':form.errors.has('name')}"
                            >
                            <HasError :form="form" field="name" />
                        </div>
                        <div class="mb-3">
                            <input id="email"
                                   placeholder="Email"
                                   v-model="form.email"
                                   type="emial"
                                   name="email"
                                   class="form-control"
                                   :class="{'is_invalid':form.errors.has('email')}"
                            >
                            <HasError :form="form" field="email" />
                        </div>
                        <div class="mb-3">
                            <input id="password"
                                   placeholder="Password"
                                   v-model="form.password"
                                   type="password" name="password"
                                   class="form-control"
                                   :class="{'is_invalid':form.errors.has('password')}"
                            >
                            <HasError :form="form" field="password" />
                        </div>
                        <div class="mb-3">
                            <select id="type"
                                   v-model="form.type"
                                   name="type"
                                   class="form-control"
                                   :class="{'is_invalid':form.errors.has('type')}"
                            >
                                <option value="">Select User Role</option>
                                <option value="admin"  >Admin</option>
                                <option value="user" selected >User</option>
                                <option value="author">Author</option>
                            </select>
                            <HasError :form="form" field="type" />
                        </div>
                        <div class="mb-3">
                        <textarea id="bio"
                                  placeholder="Short bio for user (Optional)"
                                  v-model="form.bio"
                                  type="text"
                                  name="bio"
                                  class="form-control"
                                  :class="{'is_invalid':form.errors.has('bio')}">
                        </textarea>
                            <HasError :form="form" field="bio" />
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit"  class="btn btn-primary">Create</button>
                            </div>
                        </form>


                    </div>


                </div>
            </div>
        </div>
        <div class="modal" id="editUser" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateUser">
                            <div class="mb-3">
                                <input
                                       placeholder="Name"
                                       v-model="form.name"
                                       type="text" name="name"
                                       class="form-control"
                                       :class="{'is_invalid':form.errors.has('name')}"
                                >
                                <HasError :form="form" field="name" />
                            </div>
                            <div class="mb-3">
                                <input
                                       placeholder="Email"
                                       v-model="form.email"
                                       type="emial"
                                       name="email"
                                       class="form-control"
                                       :class="{'is_invalid':form.errors.has('email')}"
                                >
                                <HasError :form="form" field="email" />
                            </div>
                            <div class="mb-3">
                                <input
                                       placeholder="Password"
                                       v-model="form.password"
                                       type="password" name="password"
                                       class="form-control"
                                       :class="{'is_invalid':form.errors.has('password')}"
                                >
                                <HasError :form="form" field="password" />
                            </div>
                            <div class="mb-3">
                                <select
                                        v-model="form.type"
                                        name="type"
                                        class="form-control"
                                        :class="{'is_invalid':form.errors.has('type')}"
                                >
                                    <option value="">Select User Role</option>
                                    <option value="admin"  >Admin</option>
                                    <option value="user" selected >User</option>
                                    <option value="author">Author</option>
                                </select>
                                <HasError :form="form" field="type" />
                            </div>
                            <div class="mb-3">
                        <textarea
                                  placeholder="Short bio for user (Optional)"
                                  v-model="form.bio"
                                  type="text"
                                  name="bio"
                                  class="form-control"
                                  :class="{'is_invalid':form.errors.has('bio')}">
                        </textarea>
                                <HasError :form="form" field="bio" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
  data(){
      return {
          form:new Form({
           name:'',
           email:'',
           password:'',
           bio:'',
           type:'',
           photo:'',
        }),
          users:{},
          user_update:''
      }
  },

  methods:{
      getResults(page = 1) {
          axios.get('api/user?page=' + page)
              .then(response => {
                  this.users = response.data;
              });
      },
      loadUsers() {
          if (this.$gate.isAdminOrAuthor()){

                  axios.get('api/user')
                      .then(({data}) => {

                          this.users = data
                          console.log(this.users);
                          setTimeout(() => {
                              this.$Progress.finish()
                          }, 500)
                      }).catch(err => {
                      this.$Progress.fail()
                  })

      }else {
              this.$Progress.finish()

          }
      },
      editUser($user){
        $('#editUser').modal('show');
        this.form.fill($user);
        this.user_update=$user.id;
      },
      updateUser(){
          this.$Progress.start()
        this.form.put(`api/user/${this.user_update}`).then(res=>{
            if(res.data.status==200){
                Toast.fire({
                    icon: 'success',
                    title: 'User Updated in successfully'
                })
                Fire.$emit('AfterCreate');
                this.$Progress.finish()
                $('#editUser').modal('hide');
            }

        }).catch(err=>{

            this.$Progress.fail()

        });
      },
      addUser(){
          this.form.reset();
          $('#addNew').modal('show');
      },

      createUser(){
          this.$Progress.start()

          this.form.post('api/user')
           .then(res=>{
               //add user in users
               Fire.$emit('AfterCreate');
               setTimeout(() => {
                   this.$Progress.finish()
               }, 500)
              this.form.reset();
               Toast.fire({
                   icon: 'success',
                   title: 'User created in successfully'
               })
               $('#addNew').modal('hide');
           })
           .catch(err=>{

               this.$Progress.fail()

                       });
      },
      deleteUser(id){
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              if (result.isConfirmed) {

                  this.form.delete(`api/user/${id}`).then(res=>{
                      Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                      )
                      Fire.$emit('AfterCreate');


                  }).catch(err=>{
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text:`${err.message}!`,
                          footer: '<a href="">Try agin</a>'
                      })
                  });
              }

          })
      }
  },
    created() {
        this.$Progress.start()
        Fire.$on('searching',() => {
            let query = this.$parent.search;
            axios.get('api/findUser?q=' + query)
                .then((data) => {
                    this.users = data.data
                })
                .catch(() => {
                })
        })
        this.loadUsers();
        Fire.$on('AfterCreate',()=>{
           this.loadUsers()
        });
        // setInterval(
        //     () =>  this.loadUsers(),
        //     3000
        // );


    }

}
</script>
