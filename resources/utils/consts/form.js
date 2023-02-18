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
export const id = ref('')
export const compForm = ref({
  name:'',
  surname:'',
  age:'',
  sex:''
})