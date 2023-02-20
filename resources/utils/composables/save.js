import { form, compStyle, date } from "../consts/form.js";
export const saveCompetition = async () => {
  form.value.startTime = date.value.day + " " + date.value.time;
  form.value.style = compStyle.value.style.cname;
  form.value.competition = compStyle.value.competition.cname;
  await axios
      .post("/api/createOrUpdateDiscipline", { ...form.value })
      .then(() => {
          Object.keys(form.value).forEach((key) => (form.value[key] = ""));
          router.push("/admin/");
      })
};