// import { startStimulusApp } from '@symfony/stimulus-bridge';
// import '@symfony/autoimport';
import {Application} from 'stimulus';

// export const app = startStimulusApp(require.context('./controllers', true, /\.(j|t)sx?$/));
export const stimulusApp = Application.start();
