<?php
/**
 * This file is part of the bitbucket-api package.
 *
 * (c) Alexandru Guzinschi <alex@gentle.ro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bitbucket\API\Repositories\Refs;

use Bitbucket\API;
use Buzz\Message\MessageInterface;

/**
 * @author  Kevin Howe    <kjhowe@gmail.com>
 */
class Branches extends API\Api
{
    /**
     * Get a list of branches
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  string|array     $params  GET parameters
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function all($account, $repo, $params = array())
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/refs/branches', $account, $repo),
            $params
        );
    }

    /**
     * Get an individual branch
     *
     * @access public
     * @param  string           $account The team or individual account owning the repository.
     * @param  string           $repo    The repository identifier.
     * @param  string           $name    The branch identifier.
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function get($account, $repo, $name)
    {
        return $this->getClient()->setApiVersion('2.0')->get(
            sprintf('repositories/%s/%s/refs/branches/%s', $account, $repo, $name)
        );
    }
    
    /**
     * Create a new branch
     * It's a hack to create branches by API but it uses commit to do that. 
     *
     * @access public
     * @param  string                    $account The team or individual account owning the repository.
     * @param  string                    $repo    The repository identifier.
     * @param  string                    $name    The name of the new tag.
     * @param  string                    $hash    The hash to brnach.
     * @param  string                    $message The message in the commit.
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function create($account, $repo, $name, $hash, $message = 'Create new branch')
    {
        $params = [
            'branch' => $name,
            'parents' => $hash,
            'message' => $message
        ];

        return $this->getClient()->setApiVersion('2.0')->post(
            sprintf('repositories/%s/%s/src', $account, $repo),
            $params
        );
    }
}
