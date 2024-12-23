@extends('layouts.app')

@section('content')

<style>
    body{
        background-color: #f2f4f7;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Nav tabs -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Students</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#employee" role="tab" aria-controls="profile" aria-selected="false">Employee</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#create" role="tab" aria-controls="contact" aria-selected="false">Create new ID</a>
                    </li>
                </ul>

                <!-- Search bar at the far right with width of 50% -->
                <div class="ms-auto w-50">
                    <input type="text" class="form-control" id="search-bar" placeholder="Search..." onkeyup="searchCards()">
                </div>
            </div>

            <!-- Tab content -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row" id="student-cards">
                        <!-- Student cards will be injected here by JavaScript -->
                    </div>
                </div>
                <div class="tab-pane fade" id="employee" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row" id="employee-cards">
                        <!-- Employee cards will be injected here by JavaScript -->
                    </div>
                </div>
                <div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="contact-tab">
                    <h3>Create New ID</h3>
                    <!-- Dropdown to select student or employee -->
                    <div class="form-group">
                        <label for="id-type">Select ID Type</label>
                        <select class="form-control" id="id-type" onchange="toggleCreateForm()">
                            <option value="">-- Select Type --</option>
                            <option value="student">Student</option>
                            <option value="employee">Employee</option>
                        </select>
                    </div>

                    <!-- Dynamic form content -->
                    <div id="create-form"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let studentsData = [];
    let employeesData = [];

    // Fetch students and employees immediately when the page loads
    document.addEventListener('DOMContentLoaded', function () {
        fetchStudents();  // Fetch student data as soon as the page is ready
        fetchEmployees();  // Fetch employee data as soon as the page is ready
    });

    // Function to fetch student data
    function fetchStudents() {
        const apiKey = '{{ (config('system.api_key')) }}';

        fetch('https://api-portal.mlgcl.edu.ph/api/external/student-list', {
            method: 'GET',
            headers: {
                'Origin': 'http://idmaker.test',
                'x-api-key': apiKey,
                'Content-Type': 'application/json'
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            studentsData = data.data;
            renderStudentCards(studentsData); // Render student cards on page load
        })
        .catch(error => {
            console.error('Error fetching students:', error);
        });
    }

    // Function to fetch employee data
    function fetchEmployees() {
        const apiKey = '{{ (config('system.api_key')) }}';

        fetch('https://api-portal.mlgcl.edu.ph/api/external/employee-list', {
            method: 'GET',
            headers: {
                'Origin': 'http://idmaker.test',
                'x-api-key': apiKey,
                'Content-Type': 'application/json'
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            employeesData = data.data;
            renderEmployeeCards(employeesData); // Render employee cards on page load
        })
        .catch(error => {
            console.error('Error fetching employees:', error);
        });
    }

    // Function to render student cards
    function renderStudentCards(students) {
        const studentCardsContainer = document.getElementById('student-cards');
        studentCardsContainer.innerHTML = ''; // Clear any existing content

        students.forEach(student => {
            const card = document.createElement('div');
            card.classList.add('col-md-3', 'mb-3');
            card.innerHTML = `
                <div class="card" style="cursor: pointer;">
                    <img src="${student.qr_code}" alt="QR Code">
                    <div class="card-body">
                        <h5 class="card-title">${student.first_name} ${student.last_name}</h5>
                    </div>
                </div>
            `;

            card.addEventListener('click', () => {
                const student_fullname = `${student.first_name} ${student.last_name}`;
                window.location.href = `/student-id/${student_fullname}`;
            });

            studentCardsContainer.appendChild(card);
        });
    }

    // Function to render employee cards
    function renderEmployeeCards(employees) {
        const employeeCardsContainer = document.getElementById('employee-cards');
        employeeCardsContainer.innerHTML = ''; // Clear any existing content

        employees.forEach(employee => {
            const card = document.createElement('div');
            card.classList.add('col-md-3', 'mb-3');
            card.innerHTML = `
                <div class="card" style="cursor: pointer;">
                    <img src="${employee.qr_code}" alt="Employee QR Code" class="img-fluid">
                    <div class="card-body">
                        <h5 class="card-title">${employee.first_name} ${employee.last_name}</h5>
                    </div>
                </div>
            `;

            card.addEventListener('click', () => {
                const employee_fullname = `${employee.first_name} ${employee.last_name}`;
                window.location.href = `/employee-id/${employee_fullname}`;
            });

            employeeCardsContainer.appendChild(card);
        });
    }

    // Search function to filter student and employee cards based on the search query
    function searchCards() {
        const query = document.getElementById('search-bar').value.toLowerCase();

        // Filter students
        const filteredStudents = studentsData.filter(student => {
            const fullName = `${student.first_name} ${student.last_name}`.toLowerCase();
            return fullName.includes(query);
        });

        // Filter employees
        const filteredEmployees = employeesData.filter(employee => {
            const fullName = `${employee.first_name} ${employee.last_name}`.toLowerCase();
            return fullName.includes(query);
        });

        // Render filtered results
        renderStudentCards(filteredStudents);
        renderEmployeeCards(filteredEmployees);
    }

    // Toggle between student and employee forms based on the selected option
    function toggleCreateForm() {
        const idType = document.getElementById('id-type').value;
        const createFormContainer = document.getElementById('create-form');

        // Clear previous form content
        createFormContainer.innerHTML = '';

        if (idType === 'student') {
            // Show student form
            createFormContainer.innerHTML = `
                <h4>Create Student ID</h4>
                <form id="student-form-action">
                    <div class="form-group">
                        <label for="student-name">First Name</label>
                        <input type="text" class="form-control" id="student-name" name="student_name" placeholder="Enter student name" required>
                    </div>

                    <div class="form-group">
                        <label for="student-course">Course</label>
                        <select class="form-control" id="student-course" name="student_course" required>
                            <option value="">Select Course</option>
                            <option value="BSCS">BSCS</option>
                            <option value="BSE">BSE</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="student-dob">Date of Birth</label>
                        <input type="date" class="form-control" id="student-dob" name="student_dob" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Student ID</button>
                </form>
            `;
        } else if (idType === 'employee') {
            // Show employee form
            createFormContainer.innerHTML = `
                <h4>Create Employee ID</h4>
                <form id="employee-form-action">
                    <div class="form-group">
                        <label for="employee-name">Full Name</label>
                        <input type="text" class="form-control" id="employee-name" name="employee_name" placeholder="Enter employee name" required>
                    </div>

                    <div class="form-group">
                        <label for="employee-position">Position</label>
                        <input type="text" class="form-control" id="employee-position" name="employee_position" placeholder="Enter position" required>
                    </div>

                    <div class="form-group">
                        <label for="employee-department">Department</label>
                        <input type="text" class="form-control" id="employee-department" name="employee_department" placeholder="Enter department" required>
                    </div>

                    <div class="form-group">
                        <label for="employee-dob">Date of Birth</label>
                        <input type="date" class="form-control" id="employee-dob" name="employee_dob" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Employee ID</button>
                </form>
            `;
        }
    }
</script>

@endsection
