import { Client } from "@notionhq/client";

const notion = new Client({
  auth: process.env.NOTION_TOKEN,
});

const databaseId = process.env.NOTION_DATABASE_ID as string;

export async function getPosts() {
  const response = await notion.databases.query({
    database_id: databaseId,
  });

  return response.results.map((page: any) => {
    const props = page.properties;

    return {
      id: page.id,
      title: props.Title?.title?.[0]?.plain_text || "No title",
      content: props.content?.rich_text?.[0]?.plain_text || "",
      image:
        props["Files & media"]?.files?.[0]?.external?.url ||
        props["Files & media"]?.files?.[0]?.file?.url ||
        null,
      slug: props.Slug?.rich_text?.[0]?.plain_text || "",
    };
  });
}
