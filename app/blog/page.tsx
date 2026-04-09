import Link from "next/link"
import Image from "next/image"
import { getAllPosts } from "@/lib/posts"

export const metadata = {
  title: "Blog | TechBullion",
  description: "Latest technology news, insights, and featured articles from TechBullion.",
}

export default function BlogPage() {
  const posts = getAllPosts()

  return (
    <main className="min-h-screen bg-black text-white pt-32 pb-20">
      <div className="container mx-auto px-6">
        <div className="max-w-3xl mx-auto text-center mb-14">
          <p className="text-[#00ff88] uppercase tracking-[0.2em] text-sm mb-4">
            Blog
          </p>
          <h1 className="text-4xl md:text-6xl font-bold mb-6">
            Latest Insights from <span className="text-[#00ff88]">TechBullion</span>
          </h1>
          <p className="text-white/70 text-lg">
            Explore technology news, AI updates, startup insights, and digital business trends.
          </p>
        </div>

        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          {posts.map((post) => (
            <article
              key={post.slug}
              className="rounded-2xl border border-white/10 bg-white/5 overflow-hidden hover:border-[#00ff88]/40 transition-all"
            >
              <div className="relative h-56 w-full">
                <Image
                  src={post.image}
                  alt={post.title}
                  fill
                  className="object-cover"
                />
              </div>

              <div className="p-6">
                <div className="flex items-center gap-3 text-sm text-white/60 mb-4">
                  <span className="text-[#00ff88]">{post.category}</span>
                  <span>•</span>
                  <span>{post.date}</span>
                </div>

                <h2 className="text-2xl font-bold leading-tight mb-3">
                  <Link href={`/blog/${post.slug}`} className="hover:text-[#00ff88] transition-colors">
                    {post.title}
                  </Link>
                </h2>

                <p className="text-white/70 mb-5 leading-7">{post.excerpt}</p>

                <div className="flex items-center justify-between text-sm text-white/60">
                  <span>{post.author}</span>
                  <span>{post.readTime}</span>
                </div>

                <Link
                  href={`/blog/${post.slug}`}
                  className="inline-block mt-6 text-[#00ff88] font-semibold hover:translate-x-1 transition-transform"
                >
                  Read Article →
                </Link>
              </div>
            </article>
          ))}
        </div>
      </div>
    </main>
  )
}
