<template>
    <Navbar></Navbar>
    <table>
        <tbody>
            <tr>
                <td>
                    <h2>{{ disciplineWithCompetitors.name }}</h2>
                </td>
                <td>
                    <p>Style: {{ disciplineWithCompetitors.style }}</p>
                </td>
                <td>
                    <p>
                        Competition: 
                        {{ disciplineWithCompetitors.competition }}
                    </p>
                </td>
                <td>
                    <p>
                        Age Group:
                        {{ disciplineWithCompetitors.ageGroup }}
                    </p>
                </td>
                <td>
                    <p>
                        Start Time:
                        {{ disciplineWithCompetitors.startTime }}
                    </p>
                </td>
                <td>
                    <p>Sex: {{ disciplineWithCompetitors.sex }}</p>
                </td>
                <td>
                    <p>
                        Participants:
                        {{ disciplineWithCompetitors.participants }}
                    </p>
                </td>
                <td>
                    <p>
                        Time Not Score:
                        {{ disciplineWithCompetitors.timeNotScore }}
                    </p>
                </td>
                <td>
                    <p>
                        Big Score Wins:
                        {{ disciplineWithCompetitors.bigScoreWins }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <DataTable
        :value="disciplineWithCompetitors.sportsman"
        responsiveLayout="scroll"
        class="w-6"
    >
        <template #header>Competitors </template>
        <Column field="id" header="ID"></Column>
        <Column field="name" header="Name"></Column>
        <Column field="surname" header="Surname"></Column>
        <Column field="age" header="Age"></Column>
        <Column field="sex" header="Sex"></Column>
        <template #footer>
            In total there are
            {{ competitors ? competitors.length : 0 }} competitors.
        </template>
    </DataTable>
</template>
<script setup>
import { onMounted, ref } from "vue";

onMounted(async () => {
    getDisciplineWithCompetitors();
});
const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
const disciplineWithCompetitors = ref({});
const getDisciplineWithCompetitors = async () => {
    const response = await axios.get(`/api/discWithSportsman/${props.id}`);
    disciplineWithCompetitors.value = response.data;
    console.log(disciplineWithCompetitors.value);
    //id.value = response.data.id;
    // form.value = response.data;
};
</script>
