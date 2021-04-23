<template>
  <div>
    <div class="container-fluid fixed-top p-4">
      <div class="col-12">
        <div v-if="canLogin" class="d-flex justify-content-end">
          <div>
            <inertia-link
              v-if="$page.props.user"
              href="/dashboard"
              class="text-muted"
            >
              Dashboard
            </inertia-link>

            <template v-else>
              <inertia-link :href="route('login')" class="text-muted">
                Log in
              </inertia-link>

              <inertia-link
                v-if="canRegister"
                :href="route('register')"
                class="ml-4 text-muted"
              >
                Register
              </inertia-link>
            </template>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid my-5 pt-5 px-5">
      <div class="row justify-content-center px-4">
        <div class="col-md-12 col-lg-9">
          <!-- jumbotron -->
          <div class="card shadow-sm jumbotron">
            <h1 class="display-4">Jukebox</h1>
            <p class="lead">This is a Single Page Application.</p>
            <hr class="my-4" />
            <p v-if="!$page.props.user">
              Start by registering an account or logging in if you already
              joined.
            </p>

            <div class="row">
              <inertia-link
                v-if="$page.props.user"
                href="/dashboard"
                class="col mx-2 btn btn-dark"
              >
                Go to dashboard
              </inertia-link>

              <template v-else>
                <inertia-link
                  :href="route('login')"
                  class="col mx-2 btn border-dark"
                >
                  Log in
                </inertia-link>

                <inertia-link
                  :href="route('register')"
                  class="col mx-2 btn btn-dark"
                >
                  Register
                </inertia-link>
              </template>
            </div>
          </div>

          <div class="d-flex justify-content-between mt-3">
            <div class="text-sm text-muted">
              Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>

<script>
export default {
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },
};
</script>
