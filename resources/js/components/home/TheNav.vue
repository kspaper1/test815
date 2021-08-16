<template>

    <ul class="nav">
        <li class="nav-item">
            <router-link :to="{name: 'Dashboard'}" class="nav-link"> Dashboard </router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'Grid'}" class="nav-link"> Grid </router-link>
        </li>
    </ul>
</template>

<script>
export default {
  name: 'TheNav',
}
</script>

<style>
</style>
