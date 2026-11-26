import { initializeApp } from "firebase/app";
import {
  getAuth,
  createUserWithEmailAndPassword,
  signInWithEmailAndPassword,
  GoogleAuthProvider,
  signInWithPopup,
  RecaptchaVerifier,
  signInWithPhoneNumber,
  signOut,
  onAuthStateChanged,
  updateProfile
} from "firebase/auth";

const firebaseConfig = {
  apiKey: import.meta.env.VITE_FIREBASE_API_KEY,
  authDomain: import.meta.env.VITE_FIREBASE_AUTH_DOMAIN,
  projectId: import.meta.env.VITE_FIREBASE_PROJECT_ID,
  storageBucket: import.meta.env.VITE_FIREBASE_STORAGE_BUCKET,
  messagingSenderId: import.meta.env.VITE_FIREBASE_MESSAGING_SENDER_ID,
  appId: import.meta.env.VITE_FIREBASE_APP_ID,
  measurementId: import.meta.env.VITE_FIREBASE_MEASUREMENT_ID
};

const app = initializeApp(firebaseConfig);
export const auth = getAuth(app);

const googleProvider = new GoogleAuthProvider();

let recaptchaVerifier = null;
let confirmationResultGlobal = null;

export async function cadastrarComEmail(email, senha, nome = "") {
  const credencial = await createUserWithEmailAndPassword(auth, email, senha);
  if (nome) {
    await updateProfile(credencial.user, { displayName: nome });
  }
  return credencial.user;
}

export async function entrarComEmail(email, senha) {
  const credencial = await signInWithEmailAndPassword(auth, email, senha);
  return credencial.user;
}

export async function entrarComGoogle() {
  const credencial = await signInWithPopup(auth, googleProvider);
  return credencial.user;
}

export async function prepararRecaptcha(containerId = "recaptcha-container", invisivel = false) {
  if (!recaptchaVerifier) {
    recaptchaVerifier = new RecaptchaVerifier(auth, containerId, {
      size: invisivel ? "invisible" : "normal",
    });
    await recaptchaVerifier.render();
  }
  return recaptchaVerifier;
}

export async function enviarCodigoTelefone(telefoneE164, containerId = "recaptcha-container", invisivel = false) {
  const verifier = await prepararRecaptcha(containerId, invisivel);
  confirmationResultGlobal = await signInWithPhoneNumber(auth, telefoneE164, verifier);
  return confirmationResultGlobal;
}

export async function confirmarCodigoTelefone(codigoSms) {
  if (!confirmationResultGlobal) {
    throw new Error("Solicite o código SMS antes de confirmar.");
  }
  const credencial = await confirmationResultGlobal.confirm(codigoSms.trim());
  return credencial.user;
}

export async function sairDoFirebase() {
  await signOut(auth);
}

export function observarUsuario(callback) {
  return onAuthStateChanged(auth, callback);
}

window.firebaseAuth = {
  auth,
  cadastrarComEmail,
  entrarComEmail,
  entrarComGoogle,
  prepararRecaptcha,
  enviarCodigoTelefone,
  confirmarCodigoTelefone,
  sairDoFirebase,
  observarUsuario
};