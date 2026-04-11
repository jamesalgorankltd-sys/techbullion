import Link from "next/link"
import Image from "next/image"
import { getPosts } from "@/lib/notion"

export async function BlogPreview() {
  const posts = await getPosts()

  const featuredPost = posts[0]
  const otherPosts = posts.slice(1, 4)

  return (
    <section className="relative py-32 bg-[#0a0a0a] overflow-hidden">
      <div className="container mx-auto px-6">

        {/* Heading */}
        <div className="flex justify-between items-center mb-12">
          <h2 className="text-4xl md:text-5xl font-bold text-white">
            Latest <span className="text-[#00ff88]">Blogs</span>
          </h2>

          <Link
            href="/blog"
            className="text-white border border-gray-700 px-4 py-2 rounded-lg hover:border-[#00ff88]"
          >
            View All
          </Link>
        </div>

        {/* Grid */}
        <div className="grid lg:grid-cols-2 gap-8">

          {/* Featured Post */}
          {featuredPost && (
            <Link
              href={`/blog/${featuredPost.slug}`}
              className="group rounded-2xl overflow-hidden border border-gray-800"
            >
              {featuredPost.image && (
                <div className="relative h-[400px] w-full">
                  <Image
                    src={featuredPost.image}
                    alt={featuredPost.title}
                    fill
                    priority
                    className="object-cover group-hover:scale-105 transition"
                  />
                </div>
              )}

              <div className="p-6">
                <h3 className="text-2xl font-bold text-white mb-3 group-hover:text-[#00ff88]">
                  {featuredPost.title}
                </h3>

                <p className="text-gray-400 text-sm">
                  {featuredPost.content?.slice(0, 120)}...
                </p>
              </div>
            </Link>
          )}

          {/* Other Posts */}
          <div className="space-y-6">
            {otherPosts.map((post) => (
              <Link
                key={post.id}
                href={`/blog/${post.slug}`}
                className="flex gap-4 p-4 rounded-xl border border-gray-800 hover:border-[#00ff88]/40 transition"
              >
                {post.image && (
                  <div className="relative w-28 h-28 flex-shrink-0 rounded-lg overflow-hidden">
                    <Image
                      src={post.image}
                      alt={post.title}
                      fill
                      className="object-cover"
                    />
                  </div>
                )}

                <div>
                  <h4 className="text-white font-semibold mb-2">
                    {post.title}
                  </h4>

                  <p className="text-gray-500 text-sm">
                    {post.content?.slice(0, 80)}...
                  </p>
                </div>
              </Link>
            ))}
          </div>

        </div>
      </div>
    </section>
  )
}
