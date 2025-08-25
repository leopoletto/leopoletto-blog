import puppeteer from "puppeteer";
import path from "path";

const args = process.argv.slice(2);
const postTitle = args[0] ?? null;
const slug = args[1] ?? null;

(async () => {
    if(postTitle === null) {
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


    const screenshotPath = path.join('./', '../source/assets/images/og/', `${slug}.png`);
    await page.screenshot({path: screenshotPath, fullPage: true});

    await browser.close();
})(postTitle, slug);






