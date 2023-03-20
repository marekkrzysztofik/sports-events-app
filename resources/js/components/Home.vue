<template>
    <Navbar></Navbar>
    <div class="center">
        <div>
            <h1>Welcome to HomePage</h1>
            <p>Create your sports competition with this app</p>
        </div>
        <form @submit.prevent="submit">
      <label>
        Name:
        <input type="number" name="name" >
      </label>
      <label>
        Email:
        <input type="email" name="email" >
      </label>
      <button type="submit">Submit</button>
    </form>
    </div>
</template>
<script setup>
const submit = (event) => {
    const { name, email } = Object.fromEntries(new FormData(event.target))
    const form = { name, email }
    console.log(form)
}
</script>
