import { ref } from "vue";

export const competitions = ref([]);
export const getCompetitions = async () => {
    const response = await axios.get("/api/getDisc");
    competitions.value = response.data;
};

export const competitors = ref([]);
export const getCompetitors = async () => {
    const response = await axios.get("/api/getSportsman");
    competitors.value = response.data;
};

// export const participations = ref([]);
// export const getParticipations = async () => {
//   const response = await axios.get('/api/discWithSportsman');
//   participations.value=response.data
// }

export const deleteDisc = (disc) => {
    axios.get(`/api/deleteDisc/${disc}`).then(() => {
        getCompetitions();
    });
};

export const deleteCompetitor = (sportsman) => {
    axios.get(`/api/deleteSportsman/${sportsman}`).then(() => {
        getCompetitors();
    });
};
