import { ref } from "vue";
import { user } from "../../modules/Organizer/composables/user.js";
export const competitors = ref([]);
export const getCompetitorsByUserId = async () => {
    const response = await axios.get(
        `/api/getSportsmenByUserId/${user.value.id}`
    );
    competitors.value = response.data;
};
export const competitions = ref([]);
export const getDisciplinesByUserId = async () => {
    const response = await axios.get(
        `/api/getDisciplinesByUserId/${user.value.id}`
    );
    competitions.value = response.data;
};

export const participations = ref([]);
export const getParticipations = async () => {
    const response = await axios.get("/api/getParticipations");
    participations.value = response.data;
};
export const deleteDisc = (disc) => {
    axios.get(`/api/deleteDisciplines/${disc}`).then(() => {
        getDisciplinesByUserId();
    });
};
export const deleteCompetitor = (sportsman) => {
    axios.get(`/api/deleteSportsman/${sportsman}`).then(() => {
        getCompetitorsByUserId();
    });
};
export const deleteParticipation = (part) => {
    axios.get(`/api/deleteParticipation/${part}`).then(() => {
        getParticipations();
    }); 
};
