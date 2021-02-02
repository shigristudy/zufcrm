<template>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
              Edit Hifz Student
            </h2>
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <router-link :to="{ name: 'sponsorships.hafiz' }"
                    >Hifz Students</router-link
                  >
                </li>
                <li class="breadcrumb-item"><a href="#">Edit</a></li>
                <li class="breadcrumb-item">
                  <a href="#">{{ $route.params.id }}</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <!-- Description -->
      <section id="description" class="card">
        <div class="card-content">
          <div class="card-body">
            <form
              @submit.prevent="handleSubmit"
              @keydown="form.onKeydown($event)"
            >
              <alert-success :form="form" :message="message" />
              <div class="row">
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="full_name">Full Name</label>
                    <input
                      v-model="form.full_name"
                      :class="{ 'is-invalid': form.errors.has('full_name') }"
                      type="text"
                      class="form-control"
                      id="full_name"
                      name="full_name"
                      placeholder="Full Name"
                    />
                    <has-error :form="form" field="full_name" />
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="Father_name">Father Name</label>
                    <input
                      v-model="form.father_name"
                      :class="{ 'is-invalid': form.errors.has('father_name') }"
                      type="text"
                      class="form-control"
                      id="father_name"
                      name="father_name"
                      placeholder="Father Name"
                    />
                    <has-error :form="form" field="father_name" />
                  </fieldset>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label>Gender</label>
                    <select
                      v-model="form.gender"
                      :class="{ 'is-invalid': form.errors.has('gender') }"
                      class="form-control"
                    >
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    <has-error :form="form" field="gender" />
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="city">From City</label>
                    <input
                      v-model="form.city"
                      :class="{ 'is-invalid': form.errors.has('city') }"
                      type="text"
                      class="form-control"
                      id="city"
                      name="city"
                      placeholder="City"
                    />
                    <has-error :form="form" field="city" />
                  </fieldset>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="teacher_name">Teacher Name</label>
                    <input
                      v-model="form.teacher_name"
                      :class="{ 'is-invalid': form.errors.has('teacher_name') }"
                      type="text"
                      class="form-control"
                      id="teacher_name"
                      name="teacher_name"
                      placeholder="Teacher Name"
                    />
                    <has-error :form="form" field="teacher_name" />
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="class_name">Class Name</label>
                    <input
                      v-model="form.class_name"
                      :class="{ 'is-invalid': form.errors.has('class_name') }"
                      type="text"
                      class="form-control"
                      id="class_name"
                      name="class_name"
                      placeholder="Class Name"
                    />
                    <has-error :form="form" field="class_name" />
                  </fieldset>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input
                      v-model="form.dob"
                      :class="{ 'is-invalid': form.errors.has('dob') }"
                      type="date"
                      class="form-control"
                      id="dob"
                      name="dob"
                      placeholder="DOB"
                    />
                    <has-error :form="form" field="dob" />
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="Age">Age</label>
                    <input
                      type="number"
                      readonly
                      class="form-control"
                      :value="calculatedAge"
                      id="Age"
                      placeholder="Age"
                    />
                  </fieldset>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="student_id">Student ID</label>
                    <input
                      v-model="form.student_id"
                      :class="{ 'is-invalid': form.errors.has('student_id') }"
                      type="text"
                      class="form-control"
                      id="student_id"
                      name="student_id"
                      placeholder="Student Id"
                    />
                    <has-error :form="form" field="student_id" />
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label>Status</label>
                    <select
                      v-model="form.status"
                      :class="{ 'is-invalid': form.errors.has('status') }"
                      class="form-control"
                    >
                      <option value="active">Active</option>
                      <option value="inactive">In Active</option>
                    </select>
                    <has-error :form="form" field="status" />
                  </fieldset>
                </div>
              </div>

              <fieldset class="form-group">
                <label for="Personal Statement">Personal Statement</label>
                <textarea
                  name="personal_statement"
                  v-model="form.personal_statement"
                  :class="{
                    'is-invalid': form.errors.has('personal_statement'),
                  }"
                  class="form-control"
                ></textarea>
                <has-error :form="form" field="personal_statement" />
              </fieldset>

              <fieldset class="form-group">
                <label for="basicInputFile">Profile Picture</label>
                <div class="custom-file">
                  <input
                    :class="{
                      'is-invalid': form.errors.has('profile_picture'),
                    }"
                    name="profile_picture"
                    @change="selectFile"
                    type="file"
                    class="custom-file-input"
                    id="chooseProfilePicture"
                  />
                  <label class="custom-file-label" for="chooseProfilePicture"
                    >Choose Profile Picture</label
                  >
                </div>
                <has-error :form="form" field="profile_picture" />
              </fieldset>
              <div class="d-flex justify-content-between">
                <button
                  type="submit"
                  class="btn btn-secondary mr-1 mb-1 waves-effect waves-light"
                >
                  Back
                </button>
                <!-- <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button> -->
                <v-button :loading="form.busy" type="primary">Submit</v-button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!--/ Description -->
    </div>
  </div>
</template>

<script>
import Form from "vform";
export default {
  middleware: "auth",

  metaInfo() {
    return { title: 'Edit Hifz Student' };
  },
  data() {
    return {
        message:'',
      form: new Form({
        id:this.$route.params.id,
        student_type: "hafiz",
        full_name: "",
        father_name: "",
        gender: "Male",
        city: "",
        teacher_name: "",
        class_name: "",
        dob: "",
        student_id: "",
        personal_statement: "",
        status: "active",
        profile_picture: null,
      }),
    };
  },
  mounted() {
    this.getStudentDetails(
      "/api/student/getSingleStudent/" + this.$route.params.id
    );
  },
  methods: {
    getStudentDetails(url) {
      axios
        .get(url)
        .then((response) => {
          this.form.student_type = response.data.student_type;
          this.form.full_name = response.data.full_name;
          this.form.father_name = response.data.father_name;
          this.form.gender = response.data.gender;
          this.form.city = response.data.city;
          this.form.teacher_name = response.data.teacher_name;
          this.form.class_name = response.data.class_name;
          this.form.dob = response.data.dob;
          this.form.student_id = response.data.student_id;
          this.form.personal_statement = response.data.personal_statement;
          this.form.status = response.data.status;
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    selectFile(e) {
      const file = e.target.files[0];
      var instance = this;
      this.getBase64(file).then(function (data) {
        instance.form.profile_picture = data;
      });
    },
    async handleSubmit() {
      const response = await this.form.post("/api/student/update");
      this.message = response.data.message
    },
  },
  computed: {
    calculatedAge() {
      var from = this.form.dob.split("-");
      console.log(this.form.dob);
      var birthdateTimeStamp = new Date(from[0], from[1] - 1, from[2]);
      var cur = new Date();
      var diff = cur - birthdateTimeStamp;
      // This is the difference in milliseconds
      var currentAge = Math.floor(diff / 31557600000);
      // Divide by 1000*60*60*24*365.25

      return currentAge;
    },
  },
};
</script>
