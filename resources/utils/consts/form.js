import {ref} from 'vue'
export const date = ref({
  day: "",
  time: "",
});
export const compStyle = ref({
  style: "",
  competition: "", 
});
export const form = ref({
  name: "",
  category:"",
  ageGroup: "",
  startTime: "",
  sex: "",
  participants: "",
  timeNotScore: false,
  bigScoreWins: false,
}); 
export const compForm = ref({
  name:'',
  surname:'',
  age:'',
  sex:''
})
export const participationForm = ref({
  discipline_id:'',
  sportsman_id:'',
  score:0,
  time:0 
})

