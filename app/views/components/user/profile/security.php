<!-- SECURITY -->
<div class="container-fluid pt-4">
          <h4>Account Security</h4>
          <p>Update your email and password here.</p>
          <!-- FORM -->
          <form class="">
            <!-- EMAIL -->
            <label for="email" class="pt-2">Email:</label>
            <input
              type="email"
              class="form-control mt-2"
              aria-label="email"
              id="email"
              value="USER_EMAIL"
            />
            <!-- OLD PASSWORD -->
            <label for="old_password" class="pt-2">Old Password</label>
            <input
              type="password"
              class="form-control mt-2"
              aria-label="old_password"
              id="old_password"
            />

            <!-- New Password -->
            <label for="password" class="pt-4">New Password</label>
            <div class="input-group mt-2 flex-nowrap">
              <span class="input-group-text">Password</span>
              <input
                type="password"
                aria-label="password"
                class="form-control"
                id="password"
              />
              <span class="input-group-text">Repeat Password</span>
              <input
                type="password"
                aria-label="repeat_password"
                class="form-control"
                id="repeat_password"
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