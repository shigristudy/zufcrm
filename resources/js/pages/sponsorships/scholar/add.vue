<template>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">
              Add Scholar Student
            </h2>
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <router-link :to="{ name: 'sponsorships.scholar' }"
                    >Scholar Students</router-link
                  >
                </li>
                <li class="breadcrumb-item"><a href="#">Add</a></li>
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
              <alert-success
                :form="form"
                message="Student Added Succssfully!"
              />
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
                <div class="col-md-3">
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
                <div class="col-md-3">
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
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="province">From Province</label>
                    <input
                      v-model="form.province"
                      :class="{ 'is-invalid': form.errors.has('province') }"
                      type="text"
                      class="form-control"
                      id="province"
                      name="province"
                      placeholder="province"
                    />
                    <has-error :form="form" field="province" />
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
                <div class="col-md-4">
                  <fieldset class="form-group">
                    <label>Para Number</label>
                    <input
                      v-model="form.para_number"
                      :class="{ 'is-invalid': form.errors.has('para_number') }"
                      type="text"
                      class="form-control"
                      id="para_number"
                      name="para_number"
                      placeholder="Student Id"
                    />
                    <has-error :form="form" field="para_number" />
                  </fieldset>
                </div>
                <div class="col-md-4">
                  <fieldset class="form-group">
                    <label>DMG Ref:</label>
                    <input
                      v-model="form.dmg_ref"
                      :class="{ 'is-invalid': form.errors.has('dmg_ref') }"
                      type="text"
                      class="form-control"
                      id="dmg_ref"
                      name="dmg_ref"
                      placeholder="Student Id"
                    />
                    <has-error :form="form" field="dmg_ref" />
                  </fieldset>
                </div>
                <div class="col-md-4">
                  <fieldset class="form-group">
                    <label>Zuf Ref:</label>
                    <input
                      v-model="form.zuf_ref"
                      :class="{ 'is-invalid': form.errors.has('zuf_ref') }"
                      type="text"
                      class="form-control"
                      id="zuf_ref"
                      name="zuf_ref"
                      placeholder="Student Id"
                    />
                    <has-error :form="form" field="zuf_ref" />
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
    return { title: 'Add Scholar Student' };
  },
  data() {
    return {
      form: new Form({
        student_type: "scholar",
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
        province:"",
        para_number:"",
        dmg_ref:"",
        zuf_ref:"",
      }),
    };
  },
  methods: {
    selectFile(e) {
      const file = e.target.files[0];
      var instance = this;
      this.getBase64(file).then(function (data) {
        instance.form.profile_picture = data;
      });
    },
    async handleSubmit() {
      const response = await this.form.post("/api/student/store");
      this.form.reset();
      this.$router.push({
        name: 'sponsorships.scholar', 
        params: { message: response.data.message }
      });
    },
  },
  computed: {
    calculatedAge() {
      var from = this.form.dob.split("-");
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
