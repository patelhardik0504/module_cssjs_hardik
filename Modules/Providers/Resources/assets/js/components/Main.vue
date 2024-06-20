<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-8 form-section">
                <h4 class="mb-3">List of employee</h4>
                <table class="table">
                    <caption>
                        List of employee
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Naran code</td>
                            <td>example@gmail.com</td>
                            <td>1234567890</td>
                            <td>
                                <span class="mr-2">
                                    <font-awesome-icon icon="trash-alt"  :style="{ color: 'red' }" />
                                </span>
                                <span>
									<font-awesome-icon :icon="['fas', 'user-edit']" />
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <Form @submit="saveData">
                    <div class="form-row form-section">
                        <h4 class="mb-3">Add Employee Info</h4>
                        <div class="col-12 mb-3">
                            <label
                                class="form-label form-label-top"
                                for="firstName"
                                >First Name
                                <span class="form-required">*</span>
                            </label>
                            <Field
                                name="first_name"
                                type="text"
                                class="form-control"
                                v-model="employee.first_name"
                                placeholder="First Name"
                                :rules="isRequired"
                            />
                            <ErrorMessage class="form-required" name="first_name" />
                        </div>
                        <div class="col-12 mb-3">
                            <label
                                class="form-label form-label-top"
                                for="lastName"
                                >Last Name
                                <span class="form-required">*</span>
                            </label>
                            <Field
                                name="last_name"
                                type="text"
                                class="form-control"
                                v-model="employee.last_name"
                                placeholder="Last Name"
                                :rules="isRequired"
                            />
                            <ErrorMessage class="form-required" name="last_name" />
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label form-label-top" for="email"
                                >Email
                                <span class="form-required">*</span></label
                            >
                            <Field
                                name="email"
                                type="email"
                                class="form-control"
                                v-model="employee.email"
                                placeholder="Email"
                                :rules="validateEmail"
                            />
                            <ErrorMessage class="form-required" name="email" />
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label form-label-top" for="email"
                                >Phone No.
                                <span class="form-required">*</span></label
                            >
                            <Field
                                name="phone"
                                type="text"
                                class="form-control"
                                v-model="employee.phone"
                                placeholder="Phone No."
                            />
                        </div>
                        <div class="col-12 mb-3">
                            <label
                                class="form-label form-label-top"
                                for="currentExperience"
                                >Current Experience</label
                            >
                            <Field name="current_experience"
                                type="text"
                                class="form-control"
                                v-model="employee.current_experience"
                                placeholder="Current Experience"
                            />
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label form-label-top" for="city"
                                >City</label
                            >
                            <Field name="city"
                                type="text"
                                class="form-control"
                                v-model="employee.city"
                                placeholder="City"
                            />
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label form-label-top" for="state"
                                >State</label
                            >
                            <Field name="state"
                                type="text"
                                class="form-control"
                                v-model="employee.state"
                                placeholder="State"
                            />
                        </div>

                        <div class="col-12 mb-3">
                            <label
                                class="form-label form-label-top"
                                for="fullName"
                                >Gender</label
                            >
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    value="male"
                                    v-model="employee.gender"
                                    checked
                                />
                                <label
                                    class="form-check-label"
                                    for="gridRadios1"
                                >
                                    Male
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    value="female"
                                    v-model="employee.gender"
                                />
                                <label
                                    class="form-check-label"
                                    for="gridRadios2"
                                >
                                    Female
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">
                            SUBMIT
                        </button>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate';
export default {
    components: {
        Form,
        Field,
        ErrorMessage
    },
    data() {
        return {
            'employee': {
                'first_name':'',
                'last_name':'',
                'email':'',
                'phone':'',
                'city':'',
                'current_experience':'',
                'state':'',
                'gender':''
            }
        };
    },

    methods: {
        isRequired(value) {
            if (value && value.trim()) {
                return true;
            }
            return 'This is required';
        },
         validateEmail(value) {
            // if the field is empty
            if (!value) {
                return 'This field is required';
            }
            // if the field is not a valid email
            const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (!regex.test(value)) {
                return 'This field must be a valid email';
            }
            // All is good
            return true;
        },
        async saveData() {
          
            axios.post('/employee/create', this.employee).then(
                response => {
                    console.log(response);
                    this.$toast.success(`Success!!! Your data hase be saved succssfully.`, {
                        // override the global option
                        position: "top-right",
                        });
                }
            ). catch(error => {
                console.log('Error here');
                this.$toast.error(`Something went wrong!`, {
                        // override the global option
                        position: "top-right",
                        });
            })
        }
    }
};
</script>

<style scope>
.form-label-top {
    width: 100%;
    margin-left: 2px;
    margin-bottom: 10px;
}

.form-label {
    color: #2c3345;
    display: inline-block;
    font-size: 16px;
    font-weight: 500;
    word-break: break-word;
}

.form-required {
    color: #f23a3c;
}

.form-section {
    border-radius: 10px;
    overflow: hidden;
    padding: 62px 55px 65px;
    box-shadow: 0 3px 20px 0 rgb(0 0 0 / 10%);
    -moz-box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.1);
    -webkit-box-shadow: 0 3px 20px 0 rgb(0 0 0 / 10%);
    -o-box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.1);
    -ms-box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.1);
}

input.form-control {
    height: 44px;
}

tbody,
td,
tfoot,
th,
thead,
tr {
    line-height: 48px;
}

.mr-2 {
    margin-right: 10px;
}
</style>
