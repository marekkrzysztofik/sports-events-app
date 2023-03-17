import { ref } from "vue";
import { user } from "../../modules/Organizer/components/Auth/user.js";
export function useCompetitions() {
    const competitions = ref([]);
    async function getCompetitionsByUserId() {
      const response = await axios.get(
        `/api/getDisciplinesByUserId/${user.value.id}`
    );
    competitions.value = response.data;
    }
    return { getCompetitionsByUserId, competitions };
}
 