<template>
    <div class="container">
        <div>
            <h1 class="title text-center pt-5">Checkout details</h1>
            <div>
                <form>
                    <div class="form-row mb-3">
                        <div class="col">
                            <input
                                type="text"
                                v-model="Name"
                                class="form-control signinEntry"
                                placeholder="Name"
                            />
                        </div>
                        <div class="col">
                            <input
                                type="text"
                                v-model="address"
                                class="form-control signinEntry"
                                placeholder="address"
                            />
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">
                            <input
                                type="email"
                                v-model="email"
                                class="form-control signinEntry"
                                placeholder="Email"
                            />
                        </div>
                    </div>
                    <!-- <div class="form-row mb-3">
                        <div class="col">
                            <input
                                type="password"
                                v-model="password"
                                class="form-control signinEntry"
                                placeholder="Password"
                            />
                        </div>
                    </div> -->
                    <div class="form-row mb-3">
                        <div class="col">
                            <input
                                type="number"
                                v-model="phone"
                                class="form-control signinEntry"
                                placeholder="Phone"
                            />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
