import puppeteer from "puppeteer";
import path from "path";

const args = process.argv.slice(2);
const postTitle = args[0] ?? null;
const description = args[1] ?? null;
const color = args[2] ?? null;

(async () => {
    if(postTitle === null || description === null) {
        console.log("No post title or description provided!");
        return;
    }


    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    await page.setViewport({width: 1230, height: 600, deviceScaleFactor: 1.0, hasTouch: false})

    const filePath = path.resolve('./', 'opengraph/template.html');
    const fileUrl = `file://${filePath}`;
    await page.goto(fileUrl);

    await page.$eval('#title', (element, postTitle) => {
        element.innerText = postTitle
    }, postTitle);

    await page.$eval('#description', (element, description) => {
        element.innerText = description
    }, description);

    const screenshotPath = path.join('./', `screenshoot.png`);
    await page.screenshot({path: screenshotPath, fullPage: true});

    await browser.close();
})(postTitle, description, color);






