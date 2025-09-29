<template>
    <section>
        <Head title="Xrate - Result" />
        <h1>Forex - Exchange Rates</h1>

        <table>
            <thead>
                <th>From (curr)</th>
                <th>To (curr)</th>
                <th>Conversion Rate</th>
            </thead>

            <tbody>
                <tr>
                    <td>{{ data.base_code }}</td>
                    <td>{{ data.target_code }}</td>
                    <td>{{ data.rate }}</td>
                </tr>
            </tbody>
        </table>
      </section>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'

defineProps({ data: Object })
</script>
