import { ref } from "vue";
import { user } from "../../modules/Organizer/components/Auth/user.js";
export function useCompetitors() {
    const competitors = ref([]);
    async function getCompetitorsByUserId() {
        const response = await axios.get(
            `/api/getSportsmenByUserId/${user.value.id}`
        );
        competitors.value = response.data;
    }
    return { getCompetitorsByUserId, competitors };
}
