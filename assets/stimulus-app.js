import { startStimulusApp } from '@symfony/stimulus-bridge';
// import '@symfony/autoimport';
// import {Application} from 'stimulus';

export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));
// export const stimulusApp = Application.start();
