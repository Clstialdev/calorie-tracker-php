
        <!-- MY DETAILS -->
        <div class="container-fluid pt-4">
          <h4>Personal Info</h4>
          <p>Update your photo and personal details here.</p>
          <!-- Name -->
          <form class="">
            <!-- FULL NAME -->
            <label for="fullname" class="pt-2">Full Name:</label>
            <input
              type="text"
              class="form-control mt-2"
              aria-label="fullname"
              id="fullname"
              value="USER_FULLNAME"
            />

            <!-- PHOTO -->
            <label for="profile-image" class="pt-4">Your Photo:</label>
            <div class="input-group mt-2 d-flex align-items-center gap-4">
              <img
                class="mr-4"
                style="
                  height: 90px;
                  width: 90px;
                  border-radius: 100%;
                  object-fit: cover;
                  object-position: 50% 0%;
                "
                src="https://images.unsplash.com/photo-1605993439219-9d09d2020fa5?q=80&w=3333&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              />
              <input
                type="file"
                aria-label="profile-image"
                class="form-control mt-2"
                style="height: fit-content"
                id="profile-image"
              />
            </div>

            <!-- Goal -->
            <label for="age" class="pt-4">Goal</label>
            <div class="input-group mt-2 flex-nowrap">
              <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01"
                  >Options</label
                >
                <select class="form-select" id="inputGroupSelect01">
                  <option selected>Choose...</option>
                  <option value="gain-weight-normal">Gain Weight</option>
                  <option value="lose-weight-normal">Lose Weight</option>
                  <option value="lose-weight-fast">Lose Weight Fast</option>
                </select>
              </div>
            </div>

            <!-- HEIGH AND WEIGHT -->
            <label for="height" class="pt-4">Height & Weight</label>
            <div class="input-group mt-2 flex-nowrap">
              <span class="input-group-text">Height</span>
              <input
                type="number"
                aria-label="height"
                class="form-control"
                id="height"
              />
              <span class="input-group-text">cm</span>
              <span class="input-group-text">Weight</span>
              <input
                type="number"
                aria-label="weight"
                class="form-control"
                id="weight"
              />
              <span class="input-group-text">kg</span>
            </div>

            <!-- Age -->
            <label for="age" class="pt-4">Age</label>
            <div class="input-group mt-2 flex-nowrap">
              <input
                type="number"
                aria-label="height"
                class="form-control"
                id="age"
              />
            </div>

            <!-- BUTTON SUBMIT -->
            <div class="d-grid gap-2 col-6 mt-4">
              <button class="btn btn-primary bg-main border-main" type="submit">
                Submit
              </button>
            </div>
          </form>
        </div>