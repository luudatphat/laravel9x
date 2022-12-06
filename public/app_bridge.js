// import createApp from "@shopify/app-bridge";
import createApp from "../node_modules/@shopify/app-bridge";

const config = {
    apiKey: '50960819d15b00d0d53fee9cacf57a7d',
    host: new URLSearchParams(location.search).get("host"),
    forceRedirect: true
};

const app = createApp(config);


