//import { useNavigateTo } from './routerUtils';
// import { competitorSex, competitorAge, sex, minAge, maxAge, participationForm} from '../consts/choose.js'
import { defineProps, ref } from 'vue';
export const props = defineProps({
  id: {
      type: String,
      default: "",
  },
});

export const disciplineWithCompetitors = ref({});




export const saveParticipation = async () => {
  let stopFunction = false;
  const response = await axios.get(
      `/api/discWithSportsman/${participationForm.value.discipline_id}`
  );
  disciplineWithCompetitors.value = response.data;
  
  if (competitorSex != sex) {
      console.error(
          "Cannot assign competitor to competition because of wrong sex"
      );
      stopFunction = true;
      return;
  }
  if (competitorAge < minAge || competitorAge > maxAge) {
      console.error(
          "Competitor is either too young or too old for this competition"
      );
      stopFunction = true;
      return;
  }
  if (
      disciplineWithCompetitors.value.sportsman.length >=
      disciplineWithCompetitors.value.participants
  ) {
      console.error("This competition is full");
      stopFunction = true;
  }
  disciplineWithCompetitors.value.sportsman.forEach((sportsman) => {
      if (sportsman.id == participationForm.value.sportsman_id) {
          console.error(
              "Competitor with this id is already assigned to this competition"
          );
          stopFunction = true;
          return;
      } 
  });
  if (stopFunction) {
      return;
  }
  await axios
      .post("/api/createOrUpdateParticipation", {
          ...participationForm.value,
      })
      .then(() => {
          Object.keys(participationForm.value).forEach(
              (key) => (participationForm.value[key] = "")
          );
         // router.push("/admin/");
      });
};