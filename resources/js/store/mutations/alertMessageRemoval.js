import { ALERT_MESSAGES } from '../store_helpers/constantVariables';

const ATTEMPT_ALERT_MESSAGE_REMOVAL = (state, payload) => {
  const messages = JSON.parse(state.alertMessages);
  messages.splice(payload, 1);
  const stringifiedMessages = JSON.stringify(messages);
  localStorage.setItem(ALERT_MESSAGES, stringifiedMessages)
  state.alertMessages = stringifiedMessages;
}

export default ATTEMPT_ALERT_MESSAGE_REMOVAL;