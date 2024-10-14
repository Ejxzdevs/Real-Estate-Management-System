<div class="d-flex flex-column p-4">
    <div class="d-flex flex-row d-flex justify-content-between w-100 h-100 " >
        <h5 class="mt-3" >Products</h5>
        <button class="btn btn-primary me-3" style="width: 120px; " data-bs-toggle="modal" data-bs-target="#addProperty" >ADD</button>
    </div>
    <table class="table align-middle mb-0 bg-white p-3 mt-4">
    <thead class="bg-light">
        <tr>
        <th>Name</th>
        <th>Title</th>
        <th>Status</th>
        <th>Position</th>
        <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td>
            <div class="d-flex align-items-center">
            <img
                src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                alt=""
                style="width: 45px; height: 45px"
                class="rounded-circle"
                />
            <div class="ms-3">
                <p class="fw-bold mb-1">John Doe</p>
                <p class="text-muted mb-0">john.doe@gmail.com</p>
            </div>
            </div>
        </td>
        <td>
            <p class="fw-normal mb-1">Software engineer</p>
            <p class="text-muted mb-0">IT department</p>
        </td>
        <td>
            <span class="badge badge-success rounded-pill d-inline">Active</span>
        </td>
        <td>Senior</td>
        <td>
            <button type="button" class="btn btn-link btn-sm btn-rounded">
            Edit
            </button>
        </td>
        </tr>
        <tr>
        <td>
            <div class="d-flex align-items-center">
            <img
                src="https://mdbootstrap.com/img/new/avatars/6.jpg"
                class="rounded-circle"
                alt=""
                style="width: 45px; height: 45px"
                />
            <div class="ms-3">
                <p class="fw-bold mb-1">Alex Ray</p>
                <p class="text-muted mb-0">alex.ray@gmail.com</p>
            </div>
            </div>
        </td>
        <td>
            <p class="fw-normal mb-1">Consultant</p>
            <p class="text-muted mb-0">Finance</p>
        </td>
        <td>
            <span class="badge badge-primary rounded-pill d-inline"
                >Onboarding</span
            >
        </td>
        <td>Junior</td>
        <td>
            <button
                    type="button"
                    class="btn btn-link btn-rounded btn-sm fw-bold"
                    data-mdb-ripple-color="dark"
                    >
            Edit
            </button>
        </td>
        </tr>
        <tr>
        <td>
            <div class="d-flex align-items-center">
            <img
                src="https://mdbootstrap.com/img/new/avatars/7.jpg"
                class="rounded-circle"
                alt=""
                style="width: 45px; height: 45px"
                />
            <div class="ms-3">
                <p class="fw-bold mb-1">Kate Hunington</p>
                <p class="text-muted mb-0">kate.hunington@gmail.com</p>
            </div>
            </div>
        </td>
        <td>
            <p class="fw-normal mb-1">Designer</p>
            <p class="text-muted mb-0">UI/UX</p>
        </td>
        <td>
            <span class="badge badge-warning rounded-pill d-inline">Awaiting</span>
        </td>
        <td>Senior</td>
        <td>
            <button
                    type="button"
                    class="btn btn-link btn-rounded btn-sm fw-bold"
                    data-mdb-ripple-color="dark"
                    >
            Edit
            </button>
        </td>
        </tr>
    </tbody>
    </table>
</div>



<!-- Modal -->
<div class="modal fade" id="addProperty" tabindex="-1" aria-labelledby="addProperty" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProperty">Add Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPropertyForm">
                    <div class="mb-3">
                        <label for="propertyName" class="form-label">Property Name</label>
                        <input type="text" class="form-control" id="propertyName" required>
                    </div>
                    <div class="mb-3">
                        <label for="propertyDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="propertyDescription" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="propertyAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="propertyAddress" required>
                    </div>
                    <div class="mb-3">
                        <label for="propertyPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="propertyPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="propertyStatus" class="form-label">Status</label>
                        <select class="form-select" id="propertyStatus" required>
                            <option value="" disabled selected>Select status</option>
                            <option value="available">Available</option>
                            <option value="sold">Sold</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="addPropertyForm">Add Property</button>
            </div>
        </div>
    </div>
</div>



