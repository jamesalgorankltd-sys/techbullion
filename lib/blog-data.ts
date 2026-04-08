export interface BlogPost {
  id: number
  slug: string
  title: string
  excerpt: string
  content: string
  category: string
  author: {
    name: string
    avatar: string
    role: string
  }
  date: string
  readTime: string
  views: string
  image: string
  tags: string[]
}

export const blogPosts: BlogPost[] = [
  {
    id: 1,
    slug: "rise-of-artificial-general-intelligence-2026",
    title: "The Rise of Artificial General Intelligence: What to Expect in 2026",
    excerpt: "Exploring the breakthroughs bringing us closer to AGI and what it means for humanity's future.",
    content: `
      <p>Artificial General Intelligence (AGI) has long been the holy grail of AI research. Unlike narrow AI systems that excel at specific tasks, AGI would possess human-like cognitive abilities, capable of learning and reasoning across any domain.</p>
      
      <h2>Recent Breakthroughs</h2>
      <p>The past year has seen remarkable progress in AI capabilities. Large language models have demonstrated emergent abilities that weren't explicitly programmed, suggesting that scale and architecture improvements are key to advancing toward AGI.</p>
      
      <p>Notable developments include:</p>
      <ul>
        <li>Multi-modal AI systems that can seamlessly process text, images, audio, and video</li>
        <li>Improved reasoning capabilities with chain-of-thought prompting</li>
        <li>Better transfer learning across domains</li>
        <li>More efficient training methods reducing computational requirements</li>
      </ul>
      
      <h2>Challenges Ahead</h2>
      <p>Despite the progress, significant challenges remain. Current AI systems still struggle with common-sense reasoning, true understanding of causality, and genuine creativity. These limitations highlight the gap between narrow AI and true AGI.</p>
      
      <h2>Implications for Society</h2>
      <p>As we inch closer to AGI, society must grapple with profound questions about employment, ethics, and the nature of intelligence itself. The decisions we make today will shape how this technology impacts future generations.</p>
      
      <p>Industry leaders and policymakers are increasingly focused on AI safety research, ensuring that as systems become more capable, they remain aligned with human values and interests.</p>
    `,
    category: "AI",
    author: {
      name: "Sarah Chen",
      avatar: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop",
      role: "AI Research Editor"
    },
    date: "Apr 5, 2026",
    readTime: "8 min read",
    views: "12.5K",
    image: "https://images.unsplash.com/photo-1677442136019-21780ecad995?w=1200&h=600&fit=crop",
    tags: ["AI", "AGI", "Machine Learning", "Future Tech"]
  },
  {
    id: 2,
    slug: "quantum-computing-reaches-new-milestone",
    title: "Quantum Computing Reaches New Milestone: IBM's Revolutionary Processor",
    excerpt: "IBM's latest quantum processor achieves unprecedented qubit coherence times, bringing practical quantum computing closer to reality.",
    content: `
      <p>In a groundbreaking announcement, IBM has unveiled their latest quantum processor, marking a significant leap forward in quantum computing capabilities.</p>
      
      <h2>The Breakthrough</h2>
      <p>The new processor demonstrates qubit coherence times that far exceed previous records. This means quantum calculations can run longer without errors, a crucial requirement for practical quantum computing applications.</p>
      
      <h2>Technical Achievements</h2>
      <p>Key improvements include:</p>
      <ul>
        <li>Extended coherence times of over 500 microseconds</li>
        <li>Reduced error rates through advanced error correction</li>
        <li>Improved qubit connectivity for more complex algorithms</li>
        <li>Better scalability for future processor generations</li>
      </ul>
      
      <h2>Industry Impact</h2>
      <p>This advancement opens new possibilities for drug discovery, financial modeling, cryptography, and optimization problems that are intractable for classical computers.</p>
      
      <p>Major corporations and research institutions are already queuing up to access the new system, eager to explore applications in their respective domains.</p>
    `,
    category: "Quantum",
    author: {
      name: "Michael Park",
      avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop",
      role: "Tech Correspondent"
    },
    date: "Apr 4, 2026",
    readTime: "5 min read",
    views: "8.2K",
    image: "https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=1200&h=600&fit=crop",
    tags: ["Quantum Computing", "IBM", "Technology", "Innovation"]
  },
  {
    id: 3,
    slug: "web3-security-protecting-digital-assets",
    title: "Web3 Security: Essential Strategies for Protecting Your Digital Assets",
    excerpt: "Essential strategies for safeguarding your cryptocurrency and NFT investments in an increasingly complex digital landscape.",
    content: `
      <p>As the Web3 ecosystem continues to expand, so do the threats targeting digital asset holders. Understanding and implementing proper security measures has never been more critical.</p>
      
      <h2>Common Attack Vectors</h2>
      <p>Hackers employ increasingly sophisticated methods to steal digital assets:</p>
      <ul>
        <li>Phishing attacks through fake websites and social engineering</li>
        <li>Smart contract vulnerabilities and exploits</li>
        <li>SIM swapping to bypass two-factor authentication</li>
        <li>Malicious browser extensions and wallet drainers</li>
      </ul>
      
      <h2>Best Practices for Security</h2>
      <p>Protect your assets with these essential measures:</p>
      <ul>
        <li>Use hardware wallets for significant holdings</li>
        <li>Enable multi-factor authentication everywhere possible</li>
        <li>Never share seed phrases or private keys</li>
        <li>Verify all transaction details before signing</li>
        <li>Use separate wallets for different purposes</li>
      </ul>
      
      <h2>Looking Forward</h2>
      <p>The industry is developing new security solutions, including social recovery wallets, advanced multi-sig implementations, and AI-powered threat detection systems.</p>
    `,
    category: "Security",
    author: {
      name: "Emma Wilson",
      avatar: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop",
      role: "Security Analyst"
    },
    date: "Apr 3, 2026",
    readTime: "6 min read",
    views: "15.1K",
    image: "https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=1200&h=600&fit=crop",
    tags: ["Web3", "Security", "Cryptocurrency", "NFT"]
  },
  {
    id: 4,
    slug: "future-remote-work-ai-collaboration",
    title: "The Future of Remote Work: How AI is Transforming Team Collaboration",
    excerpt: "How artificial intelligence is transforming the way distributed teams work together, communicate, and achieve goals.",
    content: `
      <p>Remote work has evolved from a temporary solution to a permanent fixture of the modern workplace. AI is now revolutionizing how distributed teams collaborate and maintain productivity.</p>
      
      <h2>AI-Powered Collaboration Tools</h2>
      <p>New AI tools are addressing the challenges of remote work:</p>
      <ul>
        <li>Real-time translation enabling global team communication</li>
        <li>Smart scheduling that accounts for time zones and preferences</li>
        <li>Automated meeting summaries and action item tracking</li>
        <li>Virtual assistants that handle routine tasks</li>
      </ul>
      
      <h2>Enhanced Productivity</h2>
      <p>AI is helping remote workers stay focused and efficient through intelligent notification management, automated workflow optimization, and personalized productivity recommendations.</p>
      
      <h2>The Human Element</h2>
      <p>While AI handles logistics, the focus shifts to meaningful human interactions. Teams can spend more time on creative problem-solving and relationship building rather than administrative tasks.</p>
    `,
    category: "Future Tech",
    author: {
      name: "David Kim",
      avatar: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop",
      role: "Workplace Innovation Editor"
    },
    date: "Apr 2, 2026",
    readTime: "7 min read",
    views: "9.8K",
    image: "https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200&h=600&fit=crop",
    tags: ["Remote Work", "AI", "Collaboration", "Productivity"]
  },
  {
    id: 5,
    slug: "blockchain-supply-chain-revolution",
    title: "Blockchain in Supply Chain: Transparency and Efficiency Revolution",
    excerpt: "How blockchain technology is creating unprecedented transparency and efficiency in global supply chains.",
    content: `
      <p>Global supply chains are undergoing a transformation powered by blockchain technology. From raw materials to final delivery, every step can now be tracked and verified.</p>
      
      <h2>Key Benefits</h2>
      <ul>
        <li>Complete traceability from source to consumer</li>
        <li>Reduced fraud and counterfeiting</li>
        <li>Automated compliance and documentation</li>
        <li>Faster dispute resolution</li>
      </ul>
      
      <h2>Real-World Applications</h2>
      <p>Major corporations are already implementing blockchain solutions for tracking food safety, verifying pharmaceutical authenticity, and ensuring ethical sourcing of materials.</p>
      
      <h2>Challenges and Solutions</h2>
      <p>While adoption grows, challenges remain around scalability, interoperability, and regulatory compliance. Industry consortiums are working to establish standards that will enable broader implementation.</p>
    `,
    category: "Blockchain",
    author: {
      name: "Lisa Zhang",
      avatar: "https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=100&h=100&fit=crop",
      role: "Blockchain Specialist"
    },
    date: "Apr 1, 2026",
    readTime: "6 min read",
    views: "7.3K",
    image: "https://images.unsplash.com/photo-1561414927-6d86591d0c4f?w=1200&h=600&fit=crop",
    tags: ["Blockchain", "Supply Chain", "Enterprise", "Innovation"]
  },
  {
    id: 6,
    slug: "5g-edge-computing-new-era",
    title: "5G and Edge Computing: Ushering in a New Era of Connectivity",
    excerpt: "The convergence of 5G and edge computing is enabling applications that were previously impossible.",
    content: `
      <p>The combination of 5G networks and edge computing is creating opportunities for entirely new categories of applications and services.</p>
      
      <h2>Ultra-Low Latency Applications</h2>
      <p>With latency measured in milliseconds, new applications become possible:</p>
      <ul>
        <li>Remote surgery and telemedicine</li>
        <li>Autonomous vehicle coordination</li>
        <li>Immersive AR/VR experiences</li>
        <li>Real-time industrial automation</li>
      </ul>
      
      <h2>Infrastructure Developments</h2>
      <p>Telecommunications companies and cloud providers are rapidly deploying edge computing nodes alongside 5G infrastructure, bringing computing power closer to end users.</p>
      
      <h2>Business Opportunities</h2>
      <p>Enterprises are exploring how this technology can transform their operations, from smart factories to enhanced customer experiences.</p>
    `,
    category: "Connectivity",
    author: {
      name: "James Rodriguez",
      avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop",
      role: "Telecommunications Editor"
    },
    date: "Mar 30, 2026",
    readTime: "5 min read",
    views: "6.1K",
    image: "https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=1200&h=600&fit=crop",
    tags: ["5G", "Edge Computing", "Connectivity", "IoT"]
  }
]

export const categories = [
  "All",
  "AI",
  "Blockchain",
  "Security",
  "Quantum",
  "Future Tech",
  "Connectivity"
]

export function getPostBySlug(slug: string): BlogPost | undefined {
  return blogPosts.find(post => post.slug === slug)
}

export function getPostById(id: number): BlogPost | undefined {
  return blogPosts.find(post => post.id === id)
}

export function getRelatedPosts(currentPost: BlogPost, limit: number = 3): BlogPost[] {
  return blogPosts
    .filter(post => post.id !== currentPost.id)
    .filter(post => 
      post.category === currentPost.category || 
      post.tags.some(tag => currentPost.tags.includes(tag))
    )
    .slice(0, limit)
}
